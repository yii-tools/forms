# Checkbox

It's an input element with a type attribute whose value is `checkbox` representing a [Checkbox](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox) control.

The `Checkbox` widget is designed to return the status of the checkbox.

It returns two values, by default, it's `0` for unchecked, and `1` for checked.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree']) ?>
```

That would generate the following code:

```html
<label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
```

For default, the label is generated from the attribute name. You can change it by using the `label()` method.

## Container

The following code shows how to create a checkbox with a container.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->container(true) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-agree">Agree</label>
    <input id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

## Input hidden for unchecked

The following code shows how to create a checkbox with a hidden input for unchecked.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->unchecked('0') ?>
```

That would generate the following code:

```html
<input name="ContactForm[agree]" type="hidden" value="0">
<label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
```

## Prefix

The following code shows how to create a checkbox with a prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->prefix('<span><i class="bi bi-check"></i></span>') ?>
```

That would generate the following code:

```html
<label for="contactform-agree"><span><i class="bi bi-check"></i></span><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
```

## Suffix

The following code shows how to create a checkbox with a suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->suffix('<span><i class="bi bi-check"></i></span>') ?>
```

That would generate the following code:

```html
<label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox"><span><i class="bi bi-check"></i></span>Agree</label>
```

## Field

The following code shows how to create a checkbox for a field.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-agree">Agree</label>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

## Field with change label position

The following code shows how to create a checkbox for a field with change label position.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
        ->labelContent('I agree')
        ->inputTemplate('{input}' . PHP_EOL . '{label}')
?>
```

```html
<div>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
    <label for="contactform-agree">I agree</label>
</div>
```

## Field with inside by label

The following code shows how to create a checkbox for a field with inside by label.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
        ->inputTemplate('{input}')        
?>
```

```html
<div>
    <label for="contactform-agree"><input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
</div>
```

## Field without any label

The following code shows how to create a checkbox for a field without any label.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
        ->notLabel()        
?>
```

```html
<div>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

## Field prefix

The following code shows how to create a checkbox for a field with prefix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
        ->prefix('<span><i class="bi bi-check"></i></span>')        
?>
```

```html
<div>
    <span><i class="bi bi-check"></i></span>
    <label for="contactform-agree">Agree</label>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

## Field suffix

The following code shows how to create a checkbox for a field with suffix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?=
    Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
        ->class('button is-block is-info is-fullwidth')
        ->suffix('<span><i class="bi bi-check"></i></span>')
?>
```

```html
<div>
    <label for="contactform-agree">Agree</label>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
    <span><i class="bi bi-check"></i></span>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                  | Parameter      | Description                                                                                                                                                                                                       | Default |
|-------------------------|----------------|-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------|
| `ariaDescribedBy()`     | `string`       | The value of the HTML `aria-describedby` attribute.                                                                                                                                                               | `''`    |
| `ariaLabel()`           | `string`       | The value of the HTML `aria-label` attribute.                                                                                                                                                                     | `''`    |
| `attributes()`          | `array`        | The HTML attributes for the widget.                                                                                                                                                                               | `[]`    |
| `autoFocus()`           |                | The value of the HTML `autofocus` attribute.                                                                                                                                                                      | `true`  |
| `charset()`             | `string`       | The charset of the HTML document.                                                                                                                                                                                 | `UTF-8` |
| `checked()`             | `boolean`      | The value of the HTML `checked` attribute.                                                                                                                                                                        | `false` |
| `class()`               | `string`       | The HTML class for the widget.                                                                                                                                                                                    | `''`    |
| `container()`           | `bool`         | The container for the widget.                                                                                                                                                                                     | `false` |
| `containerAttributes()` | `array`        | The HTML attributes for the container.                                                                                                                                                                            | `[]`    |
| `containerClass()`      | `string`       | The HTML class for the container.                                                                                                                                                                                 | `''`    |
| `disabled()`            |                | The value of the HTML `disabled` attribute.                                                                                                                                                                       | `false` |
| `form()`                | `string`       | The value of the HTML `form` attribute.                                                                                                                                                                           | `''`    |
| `id()`                  | `null,string`  | The value of the HTML `id` attribute.                                                                                                                                                                             | `''`    |
| `label()`               | `string`       | The label for the widget.                                                                                                                                                                                         | `true`  |
| `labelAttributes()`     | `array`        | The HTML attributes for the label.                                                                                                                                                                                | `[]`    |
| `labelClass()`          | `string`       | The HTML class for the label.                                                                                                                                                                                     | `''`    |
| `name()`                | `null,string`  | The value of the HTML `name` attribute.                                                                                                                                                                           | `''`    |
| `notLabel()`            |                | When the widget does not render the label.                                                                                                                                                                        | `null`  |
| `prefix()`              | `string`       | The prefix for the widget.                                                                                                                                                                                        | `''`    |
| `readonly()`            |                | The value of the HTML `readonly` attribute.                                                                                                                                                                       | `true`  |
| `required()`            |                | The value of the HTML `required` attribute.                                                                                                                                                                       | `true`  |
| `suffix()`              | `string`       | The suffix for the widget.                                                                                                                                                                                        | `''`    |
| `tabindex()`            | `int`          | The value of the HTML `tabindex` attribute.                                                                                                                                                                       | `0`     |
| `title()`               | `string`       | The value of the HTML `title` attribute.                                                                                                                                                                          | `''`    |
| `unchecked()`           | `string,array` | The value that should be submitted when the checkbox is not checked. The first value is the value of the HTML `value` attribute. The second value is the value of the HTML attributes for widget `Hidden::class`. | `''`    |
| `value()`               | `mixed`        | The value of the HTML `value` attribute.                                                                                                                                                                          | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/CheckboxDocTest.php) in the test file.*
