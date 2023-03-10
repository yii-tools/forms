<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Select;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class SelectDocTest extends TestCase
{
    public function testField(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-reason">Reason</label>
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            </div>
            HTML,
            Field::widget([Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent']), ])
                ->render(),
        );
    }

    public function testFieldWithPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-reason">Reason</label>
            <span>Prefix</span>
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            </div>
            HTML,
            Field::widget([Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->prefix('<span>Prefix</span>'), ])
                ->render(),
        );
    }

    public function testFieldWithSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-reason">Reason</label>
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            <span>Prefix</span>
            </div>
            HTML,
            Field::widget([Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->suffix('<span>Prefix</span>'), ])
                ->render(),
        );
    }

    public function testGroups(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-city" name="ContactForm[city]">
            <option>Select an option</option>
            <optgroup label="Russia">
            <option value="1"> Moscu</option>
            <option value="2"> San Petersburgo</option>
            <option value="3"> Novosibirsk</option>
            <option value="4"> Ekaterinburgo</option>
            </optgroup>
            <optgroup label="Chile">
            <option value="5">Santiago</option>
            <option value="6">Concepcion</option>
            <option value="7">Chillan</option>
            </optgroup>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'city'])
                ->groups(['1' => ['label' => 'Russia'], '2' => ['label' => 'Chile']])
                ->items(
                    [
                        '1' => [
                            '1' => ' Moscu',
                            '2' => ' San Petersburgo',
                            '3' => ' Novosibirsk',
                            '4' => ' Ekaterinburgo',
                        ],
                        '2' => [
                            '5' => 'Santiago',
                            '6' => 'Concepcion',
                            '7' => 'Chillan',
                        ],
                    ],
                )
                ->render(),
        );
    }

    public function testGroupsItemsAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-city" name="ContactForm[city]">
            <option>Select an option</option>
            <optgroup label="Russia">
            <option value="1"> Moscu</option>
            <option value="2" disabled> San Petersburgo</option>
            <option value="3"> Novosibirsk</option>
            <option value="4"> Ekaterinburgo</option>
            </optgroup>
            <optgroup label="Chile">
            <option value="5">Santiago</option>
            <option value="6" selected>Concepcion</option>
            <option value="7">Chillan</option>
            </optgroup>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'city'])
                ->groups(['1' => ['label' => 'Russia'], '2' => ['label' => 'Chile']])
                ->items(
                    [
                        '1' => [
                            '1' => ' Moscu',
                            '2' => ' San Petersburgo',
                            '3' => ' Novosibirsk',
                            '4' => ' Ekaterinburgo',
                        ],
                        '2' => [
                            '5' => 'Santiago',
                            '6' => 'Concepcion',
                            '7' => 'Chillan',
                        ],
                    ],
                )
                ->itemsAttributes(['2' => ['disabled' => true]])
                ->value(6)
                ->render(),
        );
    }

    public function testMultiple(): void
    {
        $formModel = new ContactForm();
        $formModel->setAttributeValue('reason', [1, 3]);

        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1" selected>Sell</option>
            <option value="2">Buy</option>
            <option value="3" selected>Rent</option>
            </select>
            HTML,
            Select::widget([$formModel, 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->render(),
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>Reason</span>
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->prefix('<span>Reason</span>')
                ->render(),
        );
    }

    public function testPrompt(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select a reason</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->prompt('Select a reason')
                ->render(),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->render(),
        );
    }

    public function testSize(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-reason" name="ContactForm[reason]" size="5">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            HTML,
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->size(5)
                ->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <select id="contactform-reason" name="ContactForm[reason]">
            <option>Select an option</option>
            <option value="1">Sell</option>
            <option value="2">Buy</option>
            <option value="3">Rent</option>
            </select>
            <span>Reason</span>
            HTML,
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->suffix('<span>Reason</span>')
                ->render(),
        );
    }
}
