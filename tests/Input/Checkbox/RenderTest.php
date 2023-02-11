<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

final class RenderTest extends TestCase
{
    public function testChecked(): void
    {
        // default value is `false`.
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="1">String</label>',
            Checkbox::widget([new TestForm(), 'string'])->value(1)->render(),
        );

        // checked value is `true`.
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="1" checked>String</label>',
            Checkbox::widget([new TestForm(), 'string'])->checked(true)->value(1)->render(),
        );
    }

    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="TestForm[string]" type="hidden" value="0">
            <label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="1">String</label>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])->hidden('0')->value(1)->render(),
        );
    }

    public function testVerticalAlignment(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])->verticalAlignment()->render(),
        );
    }

    public function testVerticalAlignmentAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test">
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])
                ->verticalAlignment()
                ->verticalAlignmentAttributes(['class' => 'test'])
                ->render(),
        );
    }

    public function testNotLabel(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="checkbox">',
            Checkbox::widget([new TestForm(), 'string'])->notLabel()->render(),
        );
    }

    public function testRender(): void
    {
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox">String</label>',
            Checkbox::widget([new TestForm(), 'string'])->render(),
        );
    }
}
