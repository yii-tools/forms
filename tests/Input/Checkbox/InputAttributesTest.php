<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Checkbox;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InputAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testValue(): void
    {
        // Value bool `false`.
        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox" value="0">Bool</label>',
            Checkbox::widget([new TestForm(), 'bool'])->value(false)->render(),
        );

        // Value bool `true`.
        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox" value="1" checked>Bool</label>',
            Checkbox::widget([new TestForm(), 'bool'])->checked(true)->value(true)->render(),
        );

        // Value int `0`.
        $this->assertSame(
            '<label for="testform-int"><input id="testform-int" name="TestForm[int]" type="checkbox" value="0">Int</label>',
            Checkbox::widget([new TestForm(), 'int'])->value(0)->render(),
        );

        // Value int `1`.
        $this->assertSame(
            '<label for="testform-int"><input id="testform-int" name="TestForm[int]" type="checkbox" value="1" checked>Int</label>',
            Checkbox::widget([new TestForm(), 'int'])->checked(true)->value(1)->render(),
        );

        // Value string `inactive`.
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="inactive">String</label>',
            Checkbox::widget([new TestForm(), 'string'])->value('inactive')->render(),
        );

        // Value string `active`.
        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="active" checked>String</label>',
            Checkbox::widget([new TestForm(), 'string'])->checked(true)->value('active')->render(),
        );

        // Value `null`.
        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox">Bool</label>',
            Checkbox::widget([new TestForm(), 'bool'])->value(null)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testValueWithFormModel(): void
    {
        $formModel = new TestForm();

        // Value bool `true`.
        $formModel->setAttributeValue('bool', true);

        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox" value="0">Bool</label>',
            Checkbox::widget([$formModel, 'bool'])->value(false)->render(),
        );
        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox" value="1" checked>Bool</label>',
            Checkbox::widget([$formModel, 'bool'])->value(true)->render(),
        );

        // Value int `1`.
        $formModel->setAttributeValue('int', 1);

        $this->assertSame(
            '<label for="testform-int"><input id="testform-int" name="TestForm[int]" type="checkbox" value="0">Int</label>',
            Checkbox::widget([$formModel, 'int'])->value(0)->render(),
        );
        $this->assertSame(
            '<label for="testform-int"><input id="testform-int" name="TestForm[int]" type="checkbox" value="1" checked>Int</label>',
            Checkbox::widget([$formModel, 'int'])->value(1)->render(),
        );

        // Value string `active`.
        $formModel->setAttributeValue('string', 'active');

        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="inactive">String</label>',
            Checkbox::widget([$formModel, 'string'])->value('inactive')->render()
        );

        $this->assertSame(
            '<label for="testform-string"><input id="testform-string" name="TestForm[string]" type="checkbox" value="active" checked>String</label>',
            Checkbox::widget([$formModel, 'string'])->value('active')->render()
        );

        // Value `null`.
        $formModel->setAttributeValue('bool', null);

        $this->assertSame(
            '<label for="testform-bool"><input id="testform-bool" name="TestForm[bool]" type="checkbox" value="1">Bool</label>',
            Checkbox::widget([$formModel, 'bool'])->value(1)->render(),
        );
    }
}
