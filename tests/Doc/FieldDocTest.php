<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yii\Support\Assert;
use Yiisoft\Validator\Validator;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class FieldDocTest extends TestCase
{
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-test="test">
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->containerAttributes(['data-test' => 'test'])
                ->render(),
        );
    }

    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test-class">
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->containerClass('test-class')->render(),
        );
    }

    public function testContainerDisabled(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->container(false)->render(),
        );
    }

    public function testInputTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <label for="contactform-name">Name</label>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->inputTemplate("{input}\n{label}")->render(),
        );
    }

    public function testInvalidClass(): void
    {
        $formModel = new ContactForm();
        $formModel->error()->add('name', 'This value must contain at least 3 characters.');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input class="is-invalid" id="contactform-name" name="ContactForm[name]" type="text">
            <div>
            This value must contain at least 3 characters.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'name'])])->invalidClass('is-invalid')->render(),
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span><i class="fas fa-user"></i></span>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->prefix('<span><i class="fas fa-user"></i></span>')
                ->render(),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->render(),
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new ContactForm();
        $formModel->load(['ContactForm' => ['name' => '1']]);
        $formModel->error()->add('name', 'This value must contain at least 3 characters.');
        $formModel->error()->add('name', 'Value is invalid.');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text" value="1">
            <div>
            This value must contain at least 3 characters.<br>Value is invalid.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'name'])])->showAllErrors()->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <span><i class="fas fa-user"></i></span>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->suffix('<span><i class="fas fa-user"></i></span>')
                ->render(),
        );
    }

    public function testTemplate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <p>This is prefix</p>
            <p>This is suffix</p>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->prefix('<p>This is prefix</p>')
                ->suffix('<p>This is suffix</p>')
                ->template("{prefix}\n{suffix}\n{field}")
                ->render(),
        );
    }

    public function testValidClass(): void
    {
        $formModel = new ContactForm();
        $formModel->load(['ContactForm' => ['name' => 'andres']]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input class="is-valid" id="contactform-name" name="ContactForm[name]" type="text" value="andres">
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'name'])])->validClass('is-valid')->render(),
        );
    }
}
