<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class LabelTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="contactform-name" data-test="test">Name</label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->labelAttributes(['data-test' => 'test'])
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label class="form-label" for="contactform-name">Name</label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->labelClass('form-label')->render(),
        );
    }

    public function testClosure(): void
    {
        $formModel = new ContactForm();

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label>Name: </label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'name'])])
                ->labelClosure(
                    static fn (ContactForm $formModel) => '<label>' . $formModel->getLabel('name') . ': </label>'
                )
                ->render(),
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="contactform-name">User name:</label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->labelContent('User name:')->render(),
        );
    }

    public function testNotLabel(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->notLabel()->render(),
        );
    }
}
