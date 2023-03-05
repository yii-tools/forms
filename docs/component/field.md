# Field

Its a widget for create a field with a input or component widget, which can be used in a form. 

For create a field, you can use the `\Yii\Forms\Field::widget()` method, which accepts an array of `\Yii\Widget\AbstractInputWidget` objects and `\Yii\Widget\AbstractWidget` objects in the constructor method.

For example, the following code for create a field with a `input text` widget.

```php	
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])]) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Elements

This field contains the following elements:

- Container
- Prefix
- Label
- Input container
- Suffix
- Hint
- Error

For default the field template its `"{prefix}\n{field}\n{suffix}\n{hint}\n{error}"` and the input template its `"{label}\n{input}"`.

The field template can be changed by the `\Yii\Forms\Field::template()` method and the input template can be changed by the `\Yii\Forms\Field::inputTemplate()` method. Additionally each input widget can have its own template, which can be changed by the `\Yii\Widget\AbstractInputWidget::template()` method.

```text
main container - div default value true.
├─── prefix
├─── label
├─── input container - div optional default value false.
│    ├──── prefix
│    ├──── input
│    └──── suffix
├─── suffix
├─── container hint
│    └──── hint
└─── container error
     └──── error
```

## Container

Its a `div` element, which can be disabled by the `\Yii\Forms\Field::container()` method.

For example, the following code for disable the main container.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'date'])])->container(false) ?>
```

That would generate the following code:

```html
<label for="contactform-name">Name</label>
<input id="contactform-name" name="ContactForm[name]" type="text">
```

For example, the following code for add attribute `HTML class` to the main container.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'date'])])->containerClass('form-group') ?>
```

That would generate the following code:

```html
<div class="test-class">
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

Or the following code for add attribute to the main container.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->containerAttributes(['data-test' => 'test']) ?>
```

That would generate the following code:

```html
<div data-test="test">
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Prefix

Allows you to add a prefix to the field in string format.

For example, the following code for add icon to the field prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->prefix('<span><i class="fas fa-user"></i></span>') ?>
```

That would generate the following code:

```html
<div>
    <span><i class="fas fa-user"></i></span>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Suffix

Allows you to add a suffix to the field in string format.

For example, the following code for add icon to the field suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->suffix('<span><i class="fas fa-user"></i></span>') ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <span><i class="fas fa-user"></i></span>
</div>
```

## Invalid class

Allows you to add a class to the field when the field is invalid.

For example, the following code for add class `is-invalid` to the field when the field is invalid.

```php
<?php

declare(strict_types=1);

use App\Form\ValidatorForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => '1']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])])->invalidClass('is-invalid') ?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input class="is-invalid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="1" maxlength="10" required minlength="3" pattern="^[a-z]+$">
    <div>
        This value must contain at least 3 characters.
    </div>
</div>
```

## Valid class

Allows you to add a class to the field when the field is valid.

For example, the following code for add class `is-valid` to the field when the field is valid.

```php
<?php

declare(strict_types=1);

use App\Form\ValidatorForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yiisoft\Validator\Validator;

$formModel = new ValidatorForm();
$formModel->load(['ValidatorForm' => ['username' => 'andres']]);
$formModel->validate(new Validator());
?>

<?= Field::widget([Text::widget([$formModel, 'username'])])->validClass('is-valid') ?>
```

That would generate the following code:

```html
<div>
    <label for="validatorform-username">Username</label>
    <input class="is-valid" id="validatorform-username" name="ValidatorForm[username]" type="text" value="andres" maxlength="10" required minlength="3" pattern="^[a-z]+$">
</div>
```

## Template

Allows you to flexibly customize the order of the field elements. The template is a string that contains the names of the elements of the field separated by break lines.

For example, the following code for change the order of the field elements.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= 
    Field::widget([Text::widget([new ContactForm(), 'name'])])
        ->prefix('<p>This is prefix</p>')
        ->suffix('<p>This is suffix</p>')
        ->template("{prefix}\n{suffix}\n{field}")
 ?>
```

That would generate the following code:

```html
<div>
    <p>This is prefix</p>
    <p>This is suffix</p>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Input template

Allows you to flexibly customize the order of the input elements. The template is a string that contains the names of the elements of the input separated by break lines.

For example, the following code for change the order of the input elements.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->inputTemplate("{input}\n{label}") ?>
```

That would generate the following code:

```html
<div>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <label for="contactform-name">Name</label>
</div>
```
