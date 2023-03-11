# TextArea

Represents a multi-line plain-text edit control for the element’s raw value editing [textarea](https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html).

## Usage

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message']) ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]"></textarea>
```

## Autocomplete

The following code shows how to create a textarea with autocomplete attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->autocomplete('on') ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" autocomplete="on"></textarea>
```

## Cols

The following code shows how to create a textarea with cols attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->Cols(10) ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" cols="10"></textarea>
```

## Dirname

The following code shows how to create a textarea with dirname attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->dirname('comment.dir') ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" dirname="comment.dir"></textarea>
```

## Maxlength

The following code shows how to create a textarea with maxlength attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->maxlength(100) ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" maxlength="100"></textarea>
```

## Minlength

The following code shows how to create a textarea with minlength attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->minlength(10) ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" minlength="10"></textarea>
```

## Placeholder

The following code shows how to create a textarea with placeholder attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->placeholder('Enter your message') ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" placeholder="Enter your message"></textarea>
```

## Prefix

The following code shows how to create a textarea with prefix:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->prefix('<span>Enter your message</span>') ?>
```

That would generate the following code:

```html
<span>Enter your message</span><textarea id="contactform-message" name="ContactForm[message]"></textarea>
```

## Rows

The following code shows how to create a textarea with rows attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->rows(10) ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" rows="10"></textarea>
```

## Suffix

The following code shows how to create a textarea with suffix:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->suffix('<span>Enter your message</span>') ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]"></textarea>
<span>Enter your message</span>
```

## Wrap

The following code shows how to create a textarea with wrap attribute:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\TextArea;
?>

<?= TextArea::widget([new ContactForm(), 'message'])->wrap('hard') ?>
```

That would generate the following code:

```html
<textarea id="contactform-message" name="ContactForm[message]" wrap="hard"></textarea>
```

## Field

The following code shows how to create a textarea with field:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\TextArea;
?>

<?= Field::widget([TextArea::widget([new ContactForm(), 'message'])]) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-message">Message</label>
    <textarea id="contactform-message" name="ContactForm[message]"></textarea>
</div>
```

## Field with prefix

The following code shows how to create a textarea with field and prefix:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\TextArea;
?>

<?= Field::widget([TextArea::widget([new ContactForm(), 'message'])])->prefix('<span>Enter your message</span>')) ?>
```

That would generate the following code:

```html
<div>
    <span>Enter your message</span>
    <label for="contactform-message">Message</label>
    <textarea id="contactform-message" name="ContactForm[message]"></textarea>
</div>
```

## Field with suffix

The following code shows how to create a textarea with field and suffix:

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\TextArea;
?>

<?= Field::widget([TextArea::widget([new ContactForm(), 'message'])])->suffix('<span>Enter your message</span>')) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-message">Message</label>
    <textarea id="contactform-message" name="ContactForm[message]"></textarea>
    <span>Enter your message</span>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method              | Parameter     | Description                                         | Default |
|---------------------|---------------|-----------------------------------------------------|---------|
| `ariaDescribedBy()` | `string`      | The value of the HTML `aria-describedby` attribute. | `''`    |
| `ariaLabel()`       | `string`      | The value of the HTML `aria-label` attribute.       | `''`    |
| `attributes()`      | `array`       | The HTML attributes for the widget.                 | `[]`    |
| `autocomplete()`    | `string`      | The value of the HTML `autocomplete` attribute.     | `''`    |
| `autoFocus()`       |               | The value of the HTML `autofocus` attribute.        | `true`  |
| `charset()`         | `string`      | The charset of the HTML document.                   | `UTF-8` |
| `class()`           | `string`      | The HTML class for the widget.                      | `''`    |
| `cols()`            | `int`         | The value of the HTML `cols` attribute.             | `0`     |
| `dirname()`         | `string`      | The value of the HTML `dirname` attribute.          | `''`    |
| `disabled()`        |               | The value of the HTML `disabled` attribute.         | `false` |
| `form()`            | `string`      | The value of the HTML `form` attribute.             | `''`    |
| `id()`              | `null,string` | The value of the HTML `id` attribute.               | `''`    |	
| `maxLength()`       | `int`         | The value of the HTML `maxlength` attribute.        | `0`     |
| `minLength()`       | `int`         | The value of the HTML `minlength` attribute.        | `0`     |
| `placeholder()`     | `string`      | The value of the HTML `placeholder` attribute.      | `''`    |
| `prefix()`          | `string`      | The prefix for the widget.                          | `''`    |
| `readonly()`        |               | The value of the HTML `readonly` attribute.         | `true`  |
| `required()`        |               | The value of the HTML `required` attribute.         | `true`  |
| `rows()`            | `int`         | The value of the HTML `rows` attribute.             | `0`     |
| `suffix()`          | `string`      | The suffix for the widget.                          | `''`    |
| `tabindex()`        | `int`         | The value of the HTML `tabindex` attribute.         | `0`     |
| `title()`           | `string`      | The value of the HTML `title` attribute.            | `''`    |
| `value()`           | `mixed`       | The value of the HTML `value` attribute.            | `''`    |
| `wrap()`            | `string`      | The value of the HTML `wrap` attribute.             | `''`    |


**Note:** *You can find all the [examples](/tests/Doc/TextAreaDocTest.php) in the test file.*
