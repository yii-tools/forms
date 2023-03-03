<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
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

    public function testContainer(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])->container(true)->render(),
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test">
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])
                ->container(true)
                ->containerAttributes(['class' => 'test'])
                ->render(),
        );
    }

    public function testContainerCssClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test">
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])
                ->container(true)
                ->containerClass('test')
                ->render(),
        );
    }

    public function testUnchecked(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input name="TestForm[string]" type="hidden" value="0">
            <label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="1">String</label>
            HTML,
            Checkbox::widget([new TestForm(), 'string'])->unchecked('0')->value(1)->render(),
        );
    }

    public function testLabel(): void
    {
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox">Red</label>',
            Checkbox::widget([new TestForm(), 'string'])->label('Red')->render(),
        );
    }

    public function testLabelAttributes(): void
    {
        $this->assertSame(
            '<label class="test-class" for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox">Red</label>',
            Checkbox::widget([new TestForm(), 'string'])
                ->label('Red')
                ->labelAttributes(['class' => 'test-class'])
                ->render(),
        );
    }

    public function testLabelClass(): void
    {
        $this->assertSame(
            '<label class="test-class" for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox">Red</label>',
            Checkbox::widget([new TestForm(), 'string'])->label('Red')->labelClass('test-class')->render(),
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
