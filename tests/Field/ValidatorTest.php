<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yii\Forms\Tests\Support\ValidatorFormAttributes;
use Yii\Support\Assert;
use Yiisoft\Validator\Validator;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidatorTest extends TestCase
{
    public function testAttributesWithShowAllErrors(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $formModel->load(['ValidatorFormAttributes' => ['username' => 's']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorformattributes-username">Username</label>
			<input class="form-control is-invalid" id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" value="s" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testAttributesWithShowAllErrorsWithTrue(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $formModel->load(['ValidatorFormAttributes' => ['username' => '']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorformattributes-username">Username</label>
			<input class="form-control is-invalid" id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			Value cannot be blank.<br>This value must contain at least 3 characters.<br>Value is invalid.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->showAllErrors()
                ->render(),
        );
    }

    public function testAttributesWithSuccess(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 'samdark']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorformattributes-username">Username</label>
			<input class="form-control" id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			Value cannot be blank.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->validClass('is-valid')
                ->render(),
        );
    }

    public function testShowAllErrors(): void
    {
        $formModel = new ValidatorForm();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 's']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input class="form-control is-invalid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="s" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testShowAllErrorsWithTrue(): void
    {
        $formModel = new ValidatorForm();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 's1']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input class="form-control is-invalid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="s1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			<div>
			This value must contain at least 3 characters.<br>Value is invalid.
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->showAllErrors()
                ->render(),
        );
    }

    public function testSuccess(): void
    {
        $formModel = new ValidatorForm();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 'samdark']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="validatorform-username">Username</label>
			<input class="form-control is-valid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="samdark" maxlength="10" required minlength="3" pattern="^[a-z]+$">
			</div>
			HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->validClass('is-valid')
                ->render(),
        );
    }
}
