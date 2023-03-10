# Date

It's an input element with a type attribute whose value is `date` representing [Date](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.date.html#input.date).

It's displayed with a calendar widget in supporting browsers, which allows easy date selection.

The format of the date is controlled by the `pattern` attribute, using the syntax described in the [HTML specification](https://www.w3.org/TR/2012/WD-html-markup-20120329/datatypes.html#common.data.date). If the `pattern` attribute isn't specified, the user personal digital assistant will give a default value.

## Usage

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Date;
?>

<?= Date::widget([new ContactForm(), 'dateofMessage']) ?>
```

That would generate the following code:

```html
<input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
```

## Prefix

The following code shows how to create a date with prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Date;
?>

<?= Date::widget([new ContactForm(), 'dateofMessage'])->prefix('<span><i class="fa fa-calendar"></i></span>') ?>
```

That would generate the following code:

```html
<span><i class="fa fa-calendar"></i></span>
<input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
```

## Suffix

The following code shows how to create a date with suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Date;
?>

<?= Date::widget([new ContactForm(), 'dateofMessage'])->suffix('<span><i class="fa fa-calendar"></i></span>') ?>
```

That would generate the following code:

```html
<input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
<span><i class="fa fa-calendar"></i></span>
```

## Field

The following code shows how to create a field for the date.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Date;
?>

<?= Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])]) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-dateofmessage">Dateof Message</label>
    <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
</div>
```

## Field prefix

The following code shows how to create a field for the date with prefix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Date;
?>

<?= Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])->prefix('<span><i class="fa fa-calendar"></i></span>')]) ?>
```

```html
<div>
    <label for="contactform-dateofmessage">Dateof Message</label>
    <span><i class="fa fa-calendar"></i></span>
    <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
</div>
```

## Field suffix

The following code shows how to create a field for the date with suffix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Date;
?>

<?= Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])->suffix('<span><i class="fa fa-calendar"></i></span>')]) ?>
```

```html
<div>
    <label for="contactform-dateofmessage">Dateof Message</label>
    <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
    <span><i class="fa fa-calendar"></i></span>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method              | Parameter     | Description                                         | Default |
|---------------------|---------------|-----------------------------------------------------|---------|
| `ariaDescribedBy()` | `string`      | The value of the HTML `aria-describedby` attribute. | `''`    |
| `ariaLabel()`       | `string`      | The value of the HTML `aria-label` attribute.       | `''`    |
| `attributes()`      | `array`       | The HTML attributes for the widget.                 | `[]`    |
| `autoFocus()`       |               | The value of the HTML `autofocus` attribute.        | `true`  |
| `charset()`         | `string`      | The charset of the HTML document.                   | `UTF-8` |
| `class()`           | `string`      | The HTML class for the widget.                      | `''`    |
| `disabled()`        |               | The value of the HTML `disabled` attribute.         | `false` |
| `form()`            | `string`      | The value of the HTML `form` attribute.             | `''`    |
| `id()`              | `null,string` | The value of the HTML `id` attribute.               | `''`    |
| `max()`             | `int,string`  | The value of the HTML `max` attribute.              | `''`    |
| `min()`             | `int,string`  | The value of the HTML `min` attribute.              | `''`    |
| `name()`            | `null,string` | The value of the HTML `name` attribute.             | `''`    |
| `prefix()`          | `string`      | The prefix for the widget.                          | `''`    |
| `readonly()`        |               | The value of the HTML `readonly` attribute.         | `true`  |
| `required()`        |               | The value of the HTML `required` attribute.         | `true`  |
| `step()`            | `int,string`  | The value of the HTML `step` attribute.             | `''`    |
| `suffix()`          | `string`      | The suffix for the widget.                          | `''`    |
| `tabindex()`        | `int`         | The value of the HTML `tabindex` attribute.         | `0`     |
| `title()`           | `string`      | The value of the HTML `title` attribute.            | `''`    |
| `value()`           | `mixed`       | The value of the HTML `value` attribute.            | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/DateDocTest.php) in the test file.*
