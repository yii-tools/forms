# Field

It's a widget to create a field with an input or part-widget, which can be used in a form. 

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

This field has the following elements:

- Container
- Prefix
- Label
- Input container
- Suffix
- Hint
- Error

For default the field template its `"{prefix}\n{field}\n{suffix}\n{hint}\n{error}"` and the input template its `"{label}\n{input}"`.

The field template can be changed by the `\Yii\Forms\Field::template()` method and the input template can be changed by the `\Yii\Forms\Field::inputTemplate()` method. Additionally, each input widget can have its own template, which can be changed by the `\Yii\Widget\AbstractInputWidget::template()` method.

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

The following code shows how to create a field without a container.

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

## Container attributes

The following code shows how to create a field with custom attributes for the container.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->containerAttributes(['data-test' => 'test']) ?>
```

## Container class

The following code shows how to create a field with a custom class for the container.

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

That would generate the following code:

```html
<div data-test="test">
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Input template

It Allows you to flexibly customize the order of the input elements. The template is a string that has the names of the elements of the input separated by break lines.

The following code shows how to create a field with a custom input template.

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

## Invalid class

It Allows you to add a class to the field when the field is invalid.

The following code shows how to create a field with a custom class when the field is invalid.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;

$formModel = new ContactForm();
$formModel->error()->add('name', 'This value must contain at least 3 characters.');
?>

<?= Field::widget([Text::widget([$formModel, 'name'])])->invalidClass('is-invalid') ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input class="is-invalid" id="contactform-name" name="ContactForm[name]" type="text">
    <div>
        This value must contain at least 3 characters.\n
    </div>
</div>
```

## Prefix

It Allows you to add a prefix to the field in string format.

The following code shows how to create a field with a custom prefix.

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

It Allows you to add a suffix to the field in string format.

The following code shows how to create a field with a custom suffix.

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

## Template

It Allows you to flexibly customize the order of the field elements. The template is a string that has the names of the elements of the field separated by break lines.

The following code shows how to create a field with a custom template.

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

## Valid class

It Allows you to add a class to the field when the field is valid.

The following code shows how to create a field with a custom class when the field is valid.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;

$formModel = new ContactForm();
$formModel->load(['ContactForm' => ['name' => 'andres']]);
?>

<?= Field::widget([Text::widget([$formModel, 'name'])])->validClass('is-valid') ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input class="is-valid" id="contactform-name" name="ContactForm[name]" type="text" value="andres">
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                  | Parameter | Description                                       | Default |
|-------------------------|-----------|---------------------------------------------------|---------|
| `ariaDescribedBy()`     | `string`  | The aria-describedby attribute.                   | `''`    |
| `class()`               | `string`  | The class of the field container.                 | `''`    |
| `container()`           | `bool`    | Allows you to enable or disable field container.  | `true`  |
| `containerAttributes()` | `bool`    | The HTML attributes for the field container.      | `true`  |
| `errorAttributes()`     | `array`   | The HTML attributes for the container tag.        | `[]`    |
| `errorClass()`          | `string`  | The HTML class for the container tag.             | `''`    |
| `errorClosure()`        | `Closure` | The closure that returns the content.             | `null`  |
| `errorContent()`        | `string`  | The content.                                      | `''`    |	
| `errortag()`            | `string`  | The tag name.                                     | `div`   |
| `hintAttribute()`       | `array`   | The HTML attributes for the container tag.        | `[]`    |
| `hintClass()`           | `string`  | The HTML class for the container tag.             | `''`    |
| `hintClosure()`         | `Closure` | The closure that returns the content.             | `null`  |
| `hintContent()`         | `string`  | The content.                                      | `''`    |	
| `hintTag()`             | `string`  | The tag name.                                     | `div`   |
| `inputTemplate()`       | `string`  | The template of the input.                        | `''`    |
| `invalidClass()`        | `string`  | The class of the field when the field is invalid. | `''`    |	
| `labelAttributes()`     | `array`   | The HTML attributes for the label tag.            | `[]`    |
| `labelClass()`          | `string`  | The HTML class for the label tag.                 | `''`    |
| `labelClosure()`        | `Closure` | The closure that returns the content.             | `null`  |
| `labelContent()`        | `string`  | The content of the label.                         | `''`    |
| `labelEncode()`         | `bool`    | Whether to encode the label content.              | `true`  |
| `notLabel()`            | `null`    | Disable the label.                                | `false` |
| `prefix()`              | `string`  | The prefix of the field.                          | `''`    |
| `showAllErrors()`       | `bool`    | Show all errors.                                  | `false` |
| `suffix()`              | `string`  | The suffix of the field.                          | `''`    |
| `template()`            | `string`  | The template of the field.                        | `''`    |
| `validClass()`          | `string`  | The class of the field when the field is valid.   | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/FieldDocTest.php) in the test file.*
