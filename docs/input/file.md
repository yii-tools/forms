# File

It's an input element with a type attribute whose value is `file` representing [File](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.file.html#input.file).

The file(s) selected by the user can then be uploaded to a server with [PSR-7](https://github.com/php-fig/http-message), or manipulated by JavaScript via the [File API](https://www.w3.org/TR/FileAPI/). 

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\File;
?>

<?=  File::widget([new ContactForm(), 'attachment']) ?>
```

That would generate the following code:

```html
<input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
```

## Input hidden for unchecked

The following code shows how to create a file with a hidden input for unchecked.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\File;
?>

<?= File::widget([new ContactForm(), 'agree'])->unchecked('0') ?>
```

That would generate the following code:

```html
<input id="contactform-agree" name="ContactForm[agree]" type="hidden" value="0">
<input id="contactform-agree" name="ContactForm[agree][]" type="file">
```

## Prefix

The following code shows how to create a file with a prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\File;
?>

<?= File::widget([new ContactForm(), 'attachment'])->prefix('<span><i class="fa fa-file"></i></span>') ?>
```

That would generate the following code:

```html
<span><i class="fa fa-file"></i></span>
<input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
```

## Suffix

The following code shows how to create a file with a suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\File;
?>

<?= File::widget([new ContactForm(), 'attachment'])->suffix('<span><i class="fa fa-file"></i></span>') ?>
```

That would generate the following code:

```html
<input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
<span><i class="fa fa-file"></i></span>
```

## Field

The following code shows how to create a field for the file.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\File;
?>

<?= Field::widget([File::widget([new ContactForm(), 'attachment'])]) ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-attachment">Attachment</label>
    <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
</div>
```

## Field with prefix

The following code shows how to create a field for the file with a prefix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\File;
?>

<?= Field::widget([File::widget([new ContactForm(), 'attachment'])->prefix('<span><i class="fa fa-file"></i></span>'), ]) ?>
```

```html
<div>
    <label for="contactform-attachment">Attachment</label>
    <span><i class="fa fa-file"></i></span>
    <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
</div>
```

## Field with suffix

The following code shows how to create a field for the file with a suffix.

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\File;
?>

<?= Field::widget([File::widget([new ContactForm(), 'attachment'])->suffix('<span><i class="fa fa-file"></i></span>'), ]) ?>
```

```html
<div>
    <label for="contactform-attachment">Attachment</label>
    <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
    <span><i class="fa fa-file"></i></span>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method              | Parameter      | Description                                                                                                                                                                                                         | Default |
|---------------------|----------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---------|
| `accept()`          | `string`       | The value of the HTML `accept` attribute.                                                                                                                                                                           | `''`    |
| `ariaDescribedBy()` | `string`       | The value of the HTML `aria-describedby` attribute.                                                                                                                                                                 | `''`    |
| `ariaLabel()`       | `string`       | The value of the HTML `aria-label` attribute.                                                                                                                                                                       | `''`    |
| `attributes()`      | `array`        | The HTML attributes for the widget.                                                                                                                                                                                 | `[]`    |
| `autoFocus()`       |                | The value of the HTML `autofocus` attribute.                                                                                                                                                                        | `true`  |
| `charset()`         | `string`       | The charset of the HTML document.                                                                                                                                                                                   | `UTF-8` |
| `class()`           | `string`       | The HTML class for the widget.                                                                                                                                                                                      | `''`    |
| `disabled()`        |                | The value of the HTML `disabled` attribute.                                                                                                                                                                         | `false` |
| `form()`            | `string`       | The value of the HTML `form` attribute.                                                                                                                                                                             | `''`    |
| `id()`              | `null,string`  | The value of the HTML `id` attribute.                                                                                                                                                                               | `''`    |
| `multiple()`        |                | The value of the HTML `multiple` attribute.                                                                                                                                                                         | `true`  |
| `name()`            | `null,string`  | The value of the HTML `name` attribute.                                                                                                                                                                             | `''`    |
| `prefix()`          | `string`       | The prefix for the widget.                                                                                                                                                                                          | `''`    |
| `readonly()`        |                | The value of the HTML `readonly` attribute.                                                                                                                                                                         | `true`  |
| `required()`        |                | The value of the HTML `required` attribute.                                                                                                                                                                         | `true`  |
| `suffix()`          | `string`       | The suffix for the widget.                                                                                                                                                                                          | `''`    |
| `tabindex()`        | `int`          | The value of the HTML `tabindex` attribute.                                                                                                                                                                         | `0`     |
| `title()`           | `string`       | The value of the HTML `title` attribute.                                                                                                                                                                            | `''`    |
| `unchecked()`       | `string,array` | The value that should be submitted when the file input is not checked. The first value is the value of the HTML `value` attribute. The second value is the value of the HTML attributes for widget `Hidden::class`. | `''`    |
| `value()`           | `mixed`        | The value of the HTML `value` attribute.                                                                                                                                                                            | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/FileDocTest.php) in the test file.*
