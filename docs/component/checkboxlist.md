# CheckboxList

It's an input element that displays a list of checkboxes [Checkbox](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox).

## Example

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
?>

<?= CheckboxList::widget([new ContactForm(), 'agree'])->items(['1' => 'Technical', '2' => 'Sales', '3' => 'Other']) ?>
```

That would generate the following code:

```html
<div id="contactform-reason">
    <label><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
</div>
```

## Example with boolean

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
?>

<?= CheckboxList::widget([new TestForm(), 'agree'])->boolean()->label('Do you like this post?') ?>
```

That would generate the following code:

```html
<label for="testform-agree">Do you like this post?</label>
<div id="testform-agree">
    <label><input name="TestForm[agree][]" type="checkbox" value="0">No</label>
    <label><input name="TestForm[agree][]" type="checkbox" value="1">Yes</label>
</div>
```

## Example with prefix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
?>

<?= 
    CheckboxList::widget([new ContactForm(), 'reason'])
        ->individualPrefix(
            [
                '1' => '<span><i class="bi bi-align-top"></i></span>',
                '2' => '<span><i class="bi bi-check"></i></span>',
                '3' => '<span><i class="bi bi-app"></i></i></span>'
            ],
        )
        ->items(['1' => 'Technical', '2' => 'Sales', '3' => 'Other'])        
?>
```

That would generate the following code:

```html
<div id="contactform-reason">
    <label><span><i class="bi bi-align-top"></i></span><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
    <label><span><i class="bi bi-check"></i></span><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
    <label><span><i class="bi bi-app"></i></i></span><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
</div>
```

## Example with suffix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
?>

<?= 
    CheckboxList::widget([new ContactForm(), 'reason'])
        ->individualSuffix(
            [
                '1' => '<span><i class="bi bi-align-top"></i></span>',
                '2' => '<span><i class="bi bi-check"></i></span>',
                '3' => '<span><i class="bi bi-app"></i></i></span>'
            ],
        )
        ->items(['1' => 'Technical', '2' => 'Sales', '3' => 'Other'])        
?>
```

That would generate the following code:

```html
<div id="contactform-reason">
    <label><input name="ContactForm[reason][]" type="checkbox" value="1">Technical<span><i class="bi bi-align-top"></i></span></label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="2">Sales<span><i class="bi bi-check"></i></span></label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="3">Other<span><i class="bi bi-app"></i></i></span></label>
</div>
```

## Example with container tag

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
?>

<?= CheckboxList::widget([new ContactForm(), 'reason'])->containerTag('article')->items(['1' => 'Technical', '2' => 'Sales', '3' => 'Other']) ?>
```

That would generate the following code:

```html
<article id="contactform-reason">
    <label><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
    <label><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
</article>
```

## Example with Field

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
?>

<?= 
    Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
        ->class('button is-block is-info is-fullwidth')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-reason">Reason</label>
    <div id="contactform-reason">
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
    </div>
</div>
```

## Example with Field change label position

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
?>

<?= 
    Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
        ->class('button is-block is-info is-fullwidth')
        ->labelContent('I agree')
        ->inputTemplate('{input}' . PHP_EOL . '{label}')
?>
```

That would generate the following code:

```html
<div>
    <div id="contactform-reason">
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
    </div>
    <label for="contactform-reason">I agree</label>
</div>
```

## Example with Field without label

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
?>

<?= 
    Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
        ->class('button is-block is-info is-fullwidth')
        ->notLabel()
?>
```

That would generate the following code:

```html
<div>
    <div id="contactform-reason">
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
    </div>
</div>
```

## Example with Field prefix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
?>

<?= 
    Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
        ->class('button is-block is-info is-fullwidth')
        ->prefix('<span><i class="bi bi-check"></i></span>')
?>
```

That would generate the following code:

```html
<div>
    <span><i class="bi bi-check"></i></span>
    <label for="contactform-reason">Reason</label>
    <div id="contactform-reason">
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
    </div>
</div>
```

## Example with Field suffix

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
?>

<?= 
    Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
        ->class('button is-block is-info is-fullwidth')
        ->suffix('<span><i class="bi bi-check"></i></span>')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-reason">Reason</label>
    <div id="contactform-reason">
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
        <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
    </div>
    <span><i class="bi bi-check"></i></span>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                   | Parameter     | Description                                                                                               | Default |
|--------------------------|---------------|-----------------------------------------------------------------------------------------------------------|---------|
| `ariaDescribedBy()`      | `string`      | The value of the HTML `aria-describedby` attribute.                                                       | `''`    |
| `ariaLabel()`            | `string`      | The value of the HTML `aria-label` attribute.                                                             | `''`    |
| `attributes()`           | `array`       | The HTML attributes for the widget.                                                                       | `[]`    |
| `autoFocus()`            |               | The value of the HTML `autofocus` attribute.                                                              | `true`  |
| `boolean()`              |               | Configured the widget `in boolean mode`. Two checkboxes will be rendered, one for `yes` and one for `no`. | `false` |
| `charset()`              | `string`      | The charset of the HTML document.                                                                         | `UTF-8` |
| `checked()`              | `boolean`     | The value of the HTML `checked` attribute.                                                                | `false` |
| `class()`                | `string`      | The HTML class for the widget.                                                                            | `''`    |
| `container()`            | `bool`        | The container for the widget.                                                                             | `false` |
| `containerAttributes() ` | `array`       | The HTML attributes for the container.                                                                    | `[]`    |
| `containerClass()`       | `string`      | The HTML class for the container.                                                                         | `''`    |
| `containerTag()`         | `string`      | The HTML tag for the container.                                                                           | `'div'` |
| `disabled()`             |               | The value of the HTML `disabled` attribute.                                                               | `false` |
| `form()`                 | `string`      | The value of the HTML `form` attribute.                                                                   | `''`    |
| `id()`                   | `null,string` | The value of the HTML `id` attribute.                                                                     | `''`    |
| `individualAttributes()` | `array`       | The HTML attributes for the individual checkboxes.                                                        | `[]`    |
| `individualPreffix()`    | `string`      | The HTML preffix for the individual checkboxes.                                                           | `''`    |
| `individualSuffix()`     | `string`      | The HTML suffix for the individual checkboxes.                                                            | `''`    |
| `label()`                | `string`      | The label for the widget.                                                                                 | `true`  |
| `labelAttributes()`      | `array`       | The HTML attributes for the label.                                                                        | `[]`    |
| `labelClass()`           | `string`      | The HTML class for the label.                                                                             | `''`    |
| `name()`                 | `null,string` | The value of the HTML `name` attribute.                                                                   | `''`    |
| `notLabel()`             |               | When the widget does not render the label.                                                                | `null`  |
| `readonly()`             |               | The value of the HTML `readonly` attribute.                                                               | `true`  |
| `required()`             |               | The value of the HTML `required` attribute.                                                               | `true`  |
| `suffix()`               | `string`      | The suffix for the widget.                                                                                | `''`    |
| `tabindex()`             | `int`         | The value of the HTML `tabindex` attribute.                                                               | `0`     |
| `title()`                | `string`      | The value of the HTML `title` attribute.                                                                  | `''`    |
| `value()`                | `mixed`       | The value of the HTML `value` attribute.                                                                  | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/CheckboxListDocTest.php) in the test file.*
