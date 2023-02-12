<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Select;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Select;
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
final class RenderTest extends TestCase
{
    use TestTrait;

    private array $cities = [
        '1' => 'Moscu',
        '2' => 'San Petersburgo',
        '3' => 'Novosibirsk',
        '4' => 'Ekaterinburgo',
    ];
    private array $citiesGroups = [
        '1' => [
            '2' => ' Moscu',
            '3' => ' San Petersburgo',
            '4' => ' Novosibirsk',
            '5' => ' Ekaterinburgo',
        ],
        '2' => [
            '6' => 'Santiago',
            '7' => 'Concepcion',
            '8' => 'Chillan',
        ],
    ];
    private array $groups = [
        '1' => ['label' => 'Russia'],
        '2' => ['label' => 'Chile'],
    ];

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testGroups(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <optgroup label="Russia">
            <option value="2"> Moscu</option>
            <option value="3"> San Petersburgo</option>
            <option value="4"> Novosibirsk</option>
            <option value="5"> Ekaterinburgo</option>
            </optgroup>
            <optgroup label="Chile">
            <option value="6">Santiago</option>
            <option value="7">Concepcion</option>
            <option value="8">Chillan</option>
            </optgroup>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->groups($this->groups)->items($this->citiesGroups)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testGroupsItemsAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <optgroup label="Russia">
            <option value="2" disabled> Moscu</option>
            <option value="3"> San Petersburgo</option>
            <option value="4"> Novosibirsk</option>
            <option value="5"> Ekaterinburgo</option>
            </optgroup>
            <optgroup label="Chile">
            <option value="6">Santiago</option>
            <option value="7">Concepcion</option>
            <option value="8" selected>Chillan</option>
            </optgroup>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])
                ->groups($this->groups)
                ->items($this->citiesGroups)
                ->itemsAttributes(['2' => ['disabled' => true]])
                ->value(8)
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testItems(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option class="test-class" value="1">Moscu</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])
                ->items([1 => 'Moscu'])
                ->itemsAttributes([1 => ['class' => 'test-class']])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testMultiple(): void
    {
        $formModel = new TestForm();
        $formModel->setAttributeValue('array', [1, 4]);

        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-array" name="TestForm[array]" multiple>
            <option>Select an option</option>
            <option value="1" selected>Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4" selected>Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'array'])->multiple()->items($this->cities)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testPrompt(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select City Birth</option>
            <option value="1">Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->prompt('Select City Birth')->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option value="0">Select City Birth</option>
            <option value="1">Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])
                ->items($this->cities)
                ->prompt('Select City Birth', '0')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->render(),
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
        // Value int `1`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1" selected>Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->value(1)->render(),
        );

        // Value int `2`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->value(2)->render(),
        );

        // Value iterable `[2, 3]`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-array" name="TestForm[array]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3" selected>Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'array'])->items($this->cities)->value([2, 3])->render(),
        );

        // Value string `1`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1" selected>Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->value('1')->render(),
        );

        // Value string `2`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->value('2')->render(),
        );

        // Value `null`.
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([new TestForm(), 'string'])->items($this->cities)->value(null)->render(),
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

        // Value int `1`.
        $formModel->setAttributeValue('string', 1);
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1" selected>Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'string'])->items($this->cities)->render(),
        );

        // Value int `2`.
        $formModel->setAttributeValue('string', 2);
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'string'])->items($this->cities)->render(),
        );

        // Value iterable `[2, 3]`.
        $formModel->setAttributeValue('array', [2, 3]);
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-array" name="TestForm[array]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3" selected>Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'array'])->items($this->cities)->render(),
        );

        // Value string `1`.
        $formModel->setAttributeValue('string', '1');
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1" selected>Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'string'])->items($this->cities)->render(),
        );

        // Value string `2`.
        $formModel->setAttributeValue('string', 2);
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2" selected>San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'string'])->items($this->cities)->render(),
        );

        // Value `null`.
        $formModel->setAttributeValue('string', null);
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="testform-string" name="TestForm[string]">
            <option>Select an option</option>
            <option value="1">Moscu</option>
            <option value="2">San Petersburgo</option>
            <option value="3">Novosibirsk</option>
            <option value="4">Ekaterinburgo</option>
            </select>
            HTML,
            Select::widget([$formModel, 'string'])->items($this->cities)->render(),
        );
    }
}
