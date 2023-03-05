# Error

For default the error its checked by the `\Yii\Widget\AbstractInputWidget::getErrorsForAttribute()` and `\Yii\Widget\AbstractInputWidget::getErrorFirstForAttribute()` methods. The `\Yii\Forms\Field::showAllErrors()` method allows you to show all errors for the attribute, otherwise it will only show the first error.

For example, the following code show using [Yii Validator](https://github.com/yiisoft/validator).

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])]) ?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div>
        This value must contain at least 3 characters.
    </div>
</div>
```

For example, the following code show using [Yii Validator](https://github.com/yiisoft/validator) for show all errors.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])])->showAllErrors() ?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div>
        This value must contain at least 3 characters.<br>Value is invalid.
    </div>
</div>
```

For example, the following code show using [Yii Validator](https://github.com/yiisoft/validator) with custom error message.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= 
    Field::widget([Text::widget([$formModel, 'username'])])
        ->errorContent('This value contain 1 character, but must contain at least 3 characters.')
?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div>
        This value contain 1 character, but must contain at least 3 characters.
    </div>
</div>
```

For example, the following code show using [Yii Validator](https://github.com/yiisoft/validator) with closure error message.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => 'sa']]);
$formModel->validate(new Validator());
?>

<?= 
    Field::widget([Text::widget([$formModel, 'username'])])
        ->errorClosure(
            static fn (ValidatorForm $formModel) => sprintf(
                'This value contain %d character, but must contain at least 3 characters.',
                mb_strlen($formModel->getUsername()),
            )
        )
?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="sa" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    This value contain 2 character, but must contain at least 3 characters.
</div>
```

For example, the following code show using [Yii Validator](https://github.com/yiisoft/validator) with error attribute `HTML class`,

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])])->errorClass('test-class') ?>
```	

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div class="test-class">
        This value must contain at least 3 characters.
    </div>
</div>
```

Finally, the following code show using [Yii Validator](https://github.com/yiisoft/validator) with add `HTML attributes` to the error.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])])->errorAttributes(['data-test' => 'test']) ?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div data-test="test">
        This value must contain at least 3 characters.
    </div>
</div>
```
