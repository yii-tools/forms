# Button

It's an input element with a type attribute whose value is `button`, `submit` or `reset`, representing a [Button](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button), labeled by its contents.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Button;
?>

<?= Button::widget() ?>
```

That would generate the following code:

```html
<input type="button">
```

## Type submit

The following example will generate a submit button.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Button;
?>

<?= Button::widget()->type('submit') ?>
```

That would generate the following code:

```html
<input type="submit">
```

## Type reset

The following example will generate a reset button.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Button;
?>

<?= Button::widget()->type('reset') ?>
```

That would generate the following code:

```html
<input type="reset">
```

## Value

The following example will generate a button with a value.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Button;
?>

<?= Button::widget()->value('Click me') ?>
```

That would generate the following code:

```html
<input type="button" value="Click me">
```

## Field

This following code will generate a field for the button.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
?>

<?= Field::widget([Button::widget()]) ?>
```

That would generate the following code:

```html
<div>
    <input type="button">
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method         | Parameter     | Description                                  | Default    |
|----------------|---------------|----------------------------------------------|------------|
| `attributes()` | `array`       | The HTML attributes for the widget.          | `[]`       |
| `autoFocus()`  | `bool`        | The value of the HTML `autofocus` attribute. | `true`     |
| `class()`      | `string`      | The HTML class for the widget.               | `''`       |
| `disabled()`   | `bool`        | The value of the HTML `disabled` attribute.  | `false`    |
| `form()`       | `string`      | The value of the HTML `form` attribute.      | `''`       |
| `id()`         | `null,string` | The value of the HTML `id` attribute.        | `''`       |
| `name()`       | `null,string` | The value of the HTML `name` attribute.      | `''`       |
| `tabIndex()`   | `int`         | The value of the HTML `tabindex` attribute.  | `0`        |
| `title()`      | `string`      | The value of the HTML `title` attribute.     | `''`       |
| `type()`       | `string`      | The value of the HTML `type` attribute.      | `'button'` |
| `value()`      | `string`      | The value of the HTML `value` attribute.     | `''`       |

**Note:** *You can find all the [examples](/tests/Doc/ButtonDocTest.php) in the test file.*
