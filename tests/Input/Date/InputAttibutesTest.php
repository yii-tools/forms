<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Date;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Date;
use Yii\Forms\Tests\Support\TestForm;

final class InputAttibutesTest extends TestCase
{
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
        $formModel->setAttributeValue('string', '1996-12-19');

        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date" value="1996-12-19">',
            Date::widget([$formModel, 'string'])->render(),
        );

        // Value `null`.
        $formModel->setAttributeValue('string', null);

        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="date">',
            Date::widget([$formModel, 'string'])->render(),
        );
    }
}
