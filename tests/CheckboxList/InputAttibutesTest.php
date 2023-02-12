<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InputAttibutesTest extends TestCase
{
    use TestTrait;

    private array $sex = [1 => 'Female', 2 => 'Male'];

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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
