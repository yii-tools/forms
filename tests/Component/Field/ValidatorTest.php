<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Field;

use PHPUnit\Framework\TestCase;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yii\Forms\Tests\Support\ValidatorFormAttributes;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Validator\Validator;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidatorTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAttributesWithShowAllErrors(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 's']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="validatorformattributes-username">Username</label>
            <input class="form-control is-invalid" id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
            <div>
            Value cannot be blank.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'username'])])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAttributesWithShowAllErrorsWithTrue(): void
    {
        $formModel = new ValidatorFormAttributes();
        $validator = new Validator();

        $formModel->load(['ValidatorForm' => ['username' => 's']]);
        $formModel->validate($validator);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="validatorformattributes-username">Username</label>
            <input class="form-control is-invalid" id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
            <div>
            Value cannot be blank.
            This value must contain at least 3 characters.
            Value is invalid.
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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
            This value must contain at least 3 characters.
            Value is invalid.
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
