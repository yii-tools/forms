# Text

It's an input element with a type attribute whose value is `text` representing [Text](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.text.html#input.text).

It can be used for any text, including e-mail addresses and URLs. The text is displayed in a fixed-width font (usually
the user's default monospace font).

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Text;
?>

<?= Text::widget([new ContactForm(), 'name']) ?>
```

That would generate the following code:

```html
<input id="contactform-name" name="ContactForm[name]" type="text">
```

## Prefix

The following code shows how to create a text with prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Text;
?>

<?= Text::widget([new ContactForm(), 'name'])->prefix('<span><i class="bi bi-person-fill"></i></span>') ?>
```

That would generate the following code:

```html
<span><i class="bi bi-person-fill"></i></span>
<input id="contactform-name" name="ContactForm[name]" type="text">
```

## Suffix

The following code shows how to create a text with suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Text;
?>

<?= Text::widget([new ContactForm(), 'name'])->suffix('<span><i class="bi bi-person-fill"></i></span>') ?>
```

That would generate the following code:

```html
<input id="contactform-name" name="ContactForm[name]" type="text">
<span><i class="bi bi-person-fill"></i></span>
```

## Field

The following code shows how to create a field for the text.

```php
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

## Field with prefix

The following code shows how to create a field for the text with prefix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])->prefix('<span><i class="bi bi-person-fill"></i></span>'), ]) ?>
```

```html
<div>
    <label for="contactform-name">Name</label>
    <span><i class="bi bi-person-fill"></i></span>
    <input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

## Field with suffix

The following code shows how to create a field for the text with suffix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])->suffix('<span><i class="bi bi-person-fill"></i></span>'), ]) ?>
```

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <span><i class="bi bi-person-fill"></i></span>
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
| `dirname()`         | `string`      | The value of the HTML `dirname` attribute.          | `''`    |
| `disabled()`        |               | The value of the HTML `disabled` attribute.         | `false` |
| `form()`            | `string`      | The value of the HTML `form` attribute.             | `''`    |
| `id()`              | `null,string` | The value of the HTML `id` attribute.               | `''`    |
| `maxlength()`       | `int`         | The value of the HTML `maxlength` attribute.        | `null`  |
| `minlength()`       | `int`         | The value of the HTML `minlength` attribute.        | `null`  |
| `name()`            | `null,string` | The value of the HTML `name` attribute.             | `''`    |
| `pattern()`         | `string`      | The value of the HTML `pattern` attribute.          | `''`    |
| `placeholder()`     | `string`      | The value of the HTML `placeholder` attribute.      | `''`    |
| `prefix()`          | `string`      | The prefix for the widget.                          | `''`    |
| `readonly()`        |               | The value of the HTML `readonly` attribute.         | `true`  |
| `required()`        |               | The value of the HTML `required` attribute.         | `true`  |
| `size()`            | `int`         | The value of the HTML `size` attribute.             | `null`  |
| `suffix()`          | `string`      | The suffix for the widget.                          | `''`    |
| `tabindex()`        | `int`         | The value of the HTML `tabindex` attribute.         | `0`     |
| `title()`           | `string`      | The value of the HTML `title` attribute.            | `''`    |
| `value()`           | `mixed`       | The value of the HTML `value` attribute.            | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/TextDocTest.php) in the test file.*
