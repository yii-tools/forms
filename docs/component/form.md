# Form

 It's a part of a web page that has [form](https://www.w3.org/TR/html52/sec-forms.html) controls, such as text, buttons,
 checkboxes, range, or color picker controls.

## Accept charset

The following code shows how to set the `accept-charset` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->acceptCharset('utf-8') ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form accept-charset="UTF-8">
    <!-- form content -->
</form>
```

## Action

The following code shows how to set the `action` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->action('/form') ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form action="/form">
    <!-- form content -->
</form>
```

## Csrf with method `POST`

The following code shows how to set the `csrf` attribute and the `method` attribute to `POST`.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::widget()->csrf('csrf-token')->method('POST')->begin() ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form method="POST" _csrf="csrf-token">
    <input name="_csrf" type="hidden" value="csrf-token">
    <!-- form content -->
</form>
```

## Enctype

The following code shows how to set the `enctype` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->enctype('multipart/form-data') ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form enctype="multipart/form-data">
    <!-- form content -->
</form>
```

## Method

The following code shows how to set the `method` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->method('GET') ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form method="GET">
    <!-- form content -->
</form>
```

## No validate

The following code shows how to set the `novalidate` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->noValidate() ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form novalidate>
    <!-- form content -->
</form>
```

## Target

The following code shows how to set the `target` attribute.

```php
<?php

declare(strict_types=1);

use Yii\Forms\Form;
?>

<?= Form::begin()->target('_blank') ?>
    <!-- form content -->
<?= Form::end() ?>
```

That would generate the following code:

```html
<form target="_blank">
    <!-- form content -->
</form>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method            | Parameter | Description                                                                         | Default |
|-------------------|-----------|-------------------------------------------------------------------------------------|---------|
| `acceptCharset()` | `string`  | Specifies the character encodings that are to be used for the form submission.      | `''`    |
| `action()`        | `string`  | Specifies where to send the form-data when a form is submitted.                     | `''`    |
| `attributes()`    | `array`   | The HTML attributes for the widget.                                                 | `[]`    |
| `autocomplete()`  | `bool`    | Specifies whether a form should have autocomplete on or off.                        | `false` |
| `begin()`         |           | Begins a form.                                                                      |         |
| `class()`         | `string`  | Specifies one or more class names for the widget.                                   | `''`    |
| `csrf()`          | `string`  | Adds a CSRF token to the form.                                                      | `''`    |
| `end()`           |           | Ends a form.                                                                        |         |
| `enctype()`       | `string`  | Specifies how the form-data should be encoded when submitting it to the server.     | `''`    |
| `id()`            | `string`  | Specifies a unique id for the widget.                                               | `''`    |
| `method()`        | `string`  | Specifies the HTTP method for sending form-data.                                    | `''`    |
| `name()`          | `string`  | Specifies the name of the widget.                                                   | `''`    |
| `noValidate()`    | `bool`    | Specifies that the form should not be validated when submitted.                     | `false` |
| `target()`        | `string`  | Specifies where to display the response that is received after submitting the form. | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/FormDocTest.php) in the test file.*
