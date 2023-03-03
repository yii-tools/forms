<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InputAttibutesTest extends TestCase
{
    private array $sex = [1 => 'Female', 2 => 'Male'];

    public function testAutofocus(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array" autofocus>
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->autofocus()->items($this->sex)->render(),
        );
    }

    public function testDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1" disabled>Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2" disabled>Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->disabled()->items($this->sex)->render(),
        );
    }

    public function testId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="id-test">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->id('id-test')->items($this->sex)->render(),
        );
    }

    public function testName(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="name-test[]" type="checkbox" value="1">Female</label>
            <label><input name="name-test[]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->name('name-test')->items($this->sex)->render(),
        );
    }

    public function testSeparator(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="id-test">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->id('id-test')
                ->items($this->sex)
                ->separator("\n")
                ->render(),
        );
    }

    public function testTabindex(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array" tabindex="1">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->items($this->sex)->tabindex(1)->render(),
        );
    }

    public function testValue(): void
    {
        // Value iterable `[2]`.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2" checked>Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->items($this->sex)->value([2])->render(),
        );

        // Value bool `true`.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="0">Inactive</label>
            <label><input name="TestForm[array][]" type="checkbox" value="1" checked>Active</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])
                ->items([false => 'Inactive', true => 'Active'])
                ->value([true])
                ->render(),
        );

        // Value `null`.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->items($this->sex)->value(null)->render(),
        );
    }

    public function testValueWithForm(): void
    {
        $formModel = new TestForm();

        // Value iterable `[2]`.
        $formModel->setAttributeValue('array', [2]);
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2" checked>Male</label>
            </div>
            HTML,
            CheckboxList::widget([$formModel, 'array'])->items($this->sex)->render(),
        );

        // Value bool `true`.
        $formModel->setAttributeValue('array', [true]);
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="0">Inactive</label>
            <label><input name="TestForm[array][]" type="checkbox" value="1" checked>Active</label>
            </div>
            HTML,
            CheckboxList::widget([$formModel, 'array'])->items([false => 'Inactive', true => 'Active'])->render(),
        );

        // Value `null`.
        $formModel->setAttributeValue('array', null);
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="testform-array">
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([$formModel, 'array'])->items($this->sex)->render(),
        );
    }

    public function testWithoutId(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label><input name="TestForm[array][]" type="checkbox" value="1">Female</label>
            <label><input name="TestForm[array][]" type="checkbox" value="2">Male</label>
            </div>
            HTML,
            CheckboxList::widget([new TestForm(), 'array'])->id(null)->items($this->sex)->render(),
        );
    }
}
