<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Forms\Tests\Support\TestForm;
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

    public function testHintAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<div data-test="test">
			String hint
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])
                ->hintAttributes(['data-test' => 'test'])
                ->render(),
        );
    }

    public function testHintClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<div class="form-hint">
			String hint
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])->hintClass('form-hint')->render(),
        );
    }

    public function testHintClosure(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<div>String hint</div>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])
                ->hintClosure(
                    static fn (TestForm $formModel) => '<div>' . $formModel->getHint('string') . '</div>'
                )
                ->render(),
        );
    }

    public function testHintContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="contactform-name">Name</label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			<div>
			Enter your name
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->hintContent('Enter your name')->render(),
        );
    }

    public function testHintTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<span>String hint</span>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])->hintTag('span')->render(),
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

    public function testLabelAttributes(): void
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

    public function testLabelClass(): void
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

    public function testLabelClosure(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label>Name: </label>
			<input id="contactform-name" name="ContactForm[name]" type="text">
			</div>
			HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])
                ->labelClosure(
                    static fn (ContactForm $formModel) => '<label>' . $formModel->getLabel('name') . ': </label>'
                )
                ->render(),
        );
    }

    public function testLabelContent(): void
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

    public function testValidator(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->render(),
        );
    }

    public function testValidatorWithCustomErrorAttributes(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div data-test="test">
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->errorAttributes(['data-test' => 'test'])->render(),
        );
    }

    public function testValidatorWithCustomErrorClass(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div class="test-class">
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->errorClass('test-class')->render(),
        );
    }

    public function testValidatorWithCustomErrorMessage(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value contain 1 character, but must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->errorContent('This value contain 1 character, but must contain at least 3 characters.')
                ->render(),
        );
    }

    public function testValidatorWithCustomErrorClosure(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => 'sa']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="sa" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			This value contain 2 character, but must contain at least 3 characters.
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->errorClosure(
                    static fn (ValidatorForm $formModel) => sprintf(
                        'This value contain %d character, but must contain at least 3 characters.',
                        mb_strlen($formModel->getUsername()),
                    )
                )
                ->render(),
        );
    }

    public function testValidatorWithInvalidClass(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input class="is-invalid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->invalidClass('is-invalid')->render(),
        );
    }

    public function testValidatorWithShowAllErrors(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => '1']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.<br>Value is invalid.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->showAllErrors()->render(),
        );
    }

    public function testValidatorWithValidClass(): void
    {
        $formModel = new ValidatorForm();
        $formModel->load(['ValidatorForm' => ['username' => 'andres']]);
        $formModel->validate(new Validator());

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input class="is-valid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="andres" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])->validClass('is-valid')->render(),
        );
    }
}
