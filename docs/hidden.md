# Hidden

It's an input element with a type attribute whose value is "hidden" representing a [Hidden](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.hidden.html#input.hidden.attrs.value) control.

## Example

```php
<?php

declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Input\Hidden;
?>

<?= Hidden::widget([new TestForm(), 'stringHidden']) ?>
```

That would generate the following code:

```html
<input id="testform-stringhidden" name="TestForm[stringHidden]" type="hidden">
```

## Example with Field

```php
declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Hidden;
?>

<?= Field::widget([Hidden::widget([new TestForm(), 'stringHidden'])]) ?>
```

That would generate the following code:

```html
<div>
    <input id="testform-stringhidden" name="TestForm[stringHidden]" type="hidden">
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method         | Parameter     | Description                                 | Default |
|----------------|---------------|---------------------------------------------|---------|
| `attributes()` | `array`       | The HTML attributes for the widget.         | `[]`    |
| `class()`      | `string`      | The HTML class for the widget.              | `''`    |
| `disabled()`   | `bool`        | The value of the HTML `disabled` attribute. | `false` |
| `form()`       | `string`      | The value of the HTML `form` attribute.     | `''`    |
| `id()`         | `null,string` | The value of the HTML `id` attribute.       | `''`    |
| `name()`       | `null,string` | The value of the HTML `name` attribute.     | `''`    |
| `value()`      | `string`      | The value of the HTML `value` attribute.    | `''`    |

**Not allowed attribute: `autofocus`, `readonly`, `required`, `tabindex` and `title`, its use will cause an exception.**

**Note:** *You can find all the [examples](/tests/Doc/HiddenDocTest.php) in the test file.*
