<?php

declare(strict_types=1);

namespace Forge\Form\Tests\Input\Date;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Date;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class InputAttibutesTest extends TestCase
{
    use TestTrait;

    public function testValue(): void
    {
        // Value string `1996-12-19`.
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date" value="1996-12-19">',
            Date::widget([new TestForm(), 'string'])->value('1996-12-19')->render(),
        );

        // Value `null`.
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date">',
            Date::widget([new TestForm(), 'string'])->value(null)->render(),
        );
    }

    public function testValueWithFormModel(): void
    {
        $formModel = new TestForm();

        // Value string `1996-12-19`.
        $formModel->setValue('string', '1996-12-19');

        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date" value="1996-12-19">',
            Date::widget([$formModel, 'string'])->render(),
        );

        // Value `null`.
        $formModel->setValue('string', null);

        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date">',
            Date::widget([$formModel, 'string'])->render(),
        );
    }
}
