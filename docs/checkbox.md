## Checkbox widget

[Checkbox](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox) is an input element with a type attribute whose value is "checkbox" represents a state or option that can be toggled.

The `Checkbox` widget is designed to return the status of the checkbox. Generally it returns two values, by default it is `0` for unchecked, and `1` for checkeded.

### Example

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->render() ?>
```

That would generate the following code:

```html
<label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
```

For default the label is generated from the attribute name. You can change it by using the `label()` method.

### Example with prefix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])
    ->prefix('<span><i class="bi bi-check"></i></span>')
    ->render()
?>
```

That would generate the following code:

```html
<label for="contactform-agree"><span><i class="bi bi-check"></i></span><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
```

### Example with suffix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])
    ->suffix('<span><i class="bi bi-check"></i></span>')
    ->render()
?>
```

That would generate the following code:

```html
<label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox"><span><i class="bi bi-check"></i></span>Agree</label>
```

### Example with container

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Checkbox;
?>

<?= Checkbox::widget([new ContactForm(), 'agree'])->container(true)->render() ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-agree">Agree</label>
    <input id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

### Example with Field

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?= Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
    ->class('button is-block is-info is-fullwidth')
    ->render()
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-agree">Agree</label>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

### Example with Field change label position

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?= Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
    ->class('button is-block is-info is-fullwidth')
    ->labelContent('I agree')
    ->inputTemplate('{input}' . PHP_EOL . '{label}')
    ->render()
?>
```

```html
<div>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
    <label for="contactform-agree">I agree</label>
</div>
```

### Example with Field enclosed by label

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?= Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
    ->class('button is-block is-info is-fullwidth')
    ->inputTemplate('{input}')
    ->render(),
?>
```

```html
<div>
    <label for="contactform-agree"><input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
</div>
```

### Example with Field any label

```php
declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
?>

<?= Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
    ->class('button is-block is-info is-fullwidth')
    ->notLabel()
    ->render(),
?>
```

```html
<div>
    <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
</div>
```

### Methods of the widget

All methods are available on the widget instance. All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

Method                 | Parameter        | Description                                                                                                           | Default
-----------------------|------------------|-----------------------------------------------------------------------------------------------------------------------|---------
`ariaDescribedBy()`    | `string`         | The value of the HTML `aria-describedby` attribute.                                                                   | `''`
`ariaLabel()`          | `string`         | The value of the HTML `aria-label` attribute.                                                                         | `''`
`attributes()`         | `array`          | The HTML attributes for the widget.                                                                                   | `[]`
`autoFocus()`          | `bool`           | The value of the HTML `autofocus` attribute.                                                                          | `true`
`charset()`            | `string`         | The charset of the HTML document.                                                                                     | `UTF-8`
`class()`              | `string`         | The HTML class for the widget.                                                                                        | `''`
`container()`          | `bool`           | The container for the widget.                                                                                         | `false`
`containerAttributes()`| `array`          | The HTML attributes for the container.                                                                                | `[]`
`containerClass()`     | `string`         | The HTML class for the container.                                                                                     | `''`
`disabled()`           | `''`             | The value of the HTML `disabled` attribute.                                                                           | `false`
`form()`               | `string`         | The value of the HTML `form` attribute.                                                                               | `''` 
`label()`              | `string`         | The label for the widget.                                                                                             | `true`
`labelAttributes()`    | `array`          | The HTML attributes for the label.                                                                                    | `[]`
`labelClass()`         | `string`         | The HTML class for the label.                                                                                         | `''`
`notLabel()`           | `''`             | When the widget does not render the label.                                                                            | `null`
`prefix()`             | `string`         | The prefix for the widget.                                                                                            | `''`
`readonly()`           | `''`             | The value of the HTML `readonly` attribute.                                                                           | `true`
`required()`           | `''`             | The value of the HTML `required` attribute.                                                                           | `true`
`suffix()`             | `string`         | The suffix for the widget.                                                                                            | `''`
`tabindex()`           | `int`            | The value of the HTML `tabindex` attribute.                                                                           | `0`
`title()`              | `string`         | The value of the HTML `title` attribute.                                                                              | `''`
`value()`              | `mixed`          | The value of the HTML `value` attribute.                                                                              | `''`

**Note:** *You can find all the [examples](/docs/checkbox.md).*