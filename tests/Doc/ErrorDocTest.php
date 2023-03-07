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
final class ErrorDocTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <div data-test="test">
            This is a custom error message.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->errorAttributes(['data-test' => 'test'])
                ->errorContent('This is a custom error message.')
                ->render(),
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <div>
            This is a custom error message.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->errorContent('This is a custom error message.')
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <div class="test-class">
            This is a custom error message.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->errorClass('test-class')
                ->errorContent('This is a custom error message.')
                ->render(),
        );
    }

    public function testClosure(): void
    {
        $formModel = new ContactForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <div>Not error found.</div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'name'])])
                ->errorClosure(
                    static fn (ContactForm $formModel) => $formModel->hasError('name')
                        ? sprintf('This is a custom error message for %s.', $formModel->getAttributeLabel('name'))
                        : '<div>Not error found.</div>'
                )
                ->render(),
        );
    }

    public function testTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <p>
            This is a custom error message.
            </p>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->errorContent('This is a custom error message.')
                ->errorTag('p')
                ->render(),
        );
    }
}
