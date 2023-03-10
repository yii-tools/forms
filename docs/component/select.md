# Select

Represents a control for selecting among a list of options [Select](https://www.w3.org/TR/2012/WD-html-markup-20120329/select.html).

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent']) ?>
```

That would generate the following code:

```html
<select id="contactform-reason" name="ContactForm[reason]">
    <option>Select an option</option>
    <option value="1">Sell</option>
    <option value="2">Buy</option>
    <option value="3">Rent</option>
</select>
```

## Groups

The following code shows how to create a select with groups.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= 
    Select::widget([new ContactForm(), 'city'])
        ->groups(['1' => ['label' => 'Russia'], '2' => ['label' => 'Chile']])
        ->items(
            [
                '1' => [
                    '1' => ' Moscu',
                    '2' => ' San Petersburgo',
                    '3' => ' Novosibirsk',
                    '4' => ' Ekaterinburgo',
                ],
                '2' => [
                    '5' => 'Santiago',
                    '6' => 'Concepcion',
                    '7' => 'Chillan',
                ],
            ],
        )
?>
```

That would generate the following code:

```html
<select id="contactform-city" name="ContactForm[city]">
    <option>Select an option</option>
    <optgroup label="Russia">
        <option value="1"> Moscu</option>
        <option value="2"> San Petersburgo</option>
        <option value="3"> Novosibirsk</option>
        <option value="4"> Ekaterinburgo</option>
    </optgroup>
    <optgroup label="Chile">
        <option value="5">Santiago</option>
        <option value="6">Concepcion</option>
        <option value="7">Chillan</option>
    </optgroup>
</select>
```

## Groups with item attributes

The following code shows how to create a select with groups and set attributes for each item.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= 
    Select::widget([new ContactForm(), 'city'])
        ->groups(['1' => ['label' => 'Russia'], '2' => ['label' => 'Chile']])
        ->items(
            [
                '1' => [
                    '1' => ' Moscu',
                    '2' => ' San Petersburgo',
                    '3' => ' Novosibirsk',
                    '4' => ' Ekaterinburgo',
                ],
                '2' => [
                    '5' => 'Santiago',
                    '6' => 'Concepcion',
                    '7' => 'Chillan',
                ],
            ],
        )
        ->itemsAttributes(['2' => ['disabled' => true]])
        ->value(6)
?>
```

That would generate the following code:

```html
<select id="contactform-city" name="ContactForm[city]">
    <option>Select an option</option>
    <optgroup label="Russia">
        <option value="1"> Moscu</option>
        <option value="2" disabled> San Petersburgo</option>
        <option value="3"> Novosibirsk</option>
        <option value="4"> Ekaterinburgo</option>
    </optgroup>
    <optgroup label="Chile">
        <option value="5">Santiago</option>
        <option value="6" selected>Concepcion</option>
        <option value="7">Chillan</option>
    </optgroup>
</select>
```

## Multiple

The following code shows how to create a multiple select.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;

$formModel = new ContactForm();
$formModel->setAttributeValue('reason', [1, 3]);
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent']) ?>
```

That would generate the following code:

```html
<select id="contactform-reason" name="ContactForm[reason]">
    <option>Select an option</option>
    <option value="1" selected>Sell</option>
    <option value="2">Buy</option>
    <option value="3" selected>Rent</option>
</select>
```

## Prompt

The following code shows how to create a select with a prompt.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->prompt('Select a reason') ?>
```

That would generate the following code:

```html
<select id="contactform-reason" name="ContactForm[reason]">
    <option>Select a reason</option>
    <option value="1">Sell</option>
    <option value="2">Buy</option>
    <option value="3">Rent</option>
</select>
```

## Size

The following code shows how to create a select with a size.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->size(5) ?>
```

That would generate the following code:

```html
<select id="contactform-reason" name="ContactForm[reason]" size="5">
    <option>Select an option</option>
    <option value="1">Sell</option>
    <option value="2">Buy</option>
    <option value="3">Rent</option>
</select>
```

## Prefix

The following code shows how to create a select with a prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->prefix('Reason') ?>
```

That would generate the following code:

```html
<span>Reason</span>
<select id="contactform-reason" name="ContactForm[reason]">
    <option>Select an option</option>
    <option value="1">Sell</option>
    <option value="2">Buy</option>
    <option value="3">Rent</option>
</select>
```

## Suffix

The following code shows how to create a select with a suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Select;
?>

<?= Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])->suffix('Reason') ?>
```

That would generate the following code:

```html
<select id="contactform-reason" name="ContactForm[reason]">
    <option>Select an option</option>
    <option value="1">Sell</option>
    <option value="2">Buy</option>
    <option value="3">Rent</option>
</select>
<span>Reason</span>
```

## Field

The following code shows how to create a select with a field.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Select;
?>

<?= 
    Field::widget(
        [
            Select::widget([new ContactForm(), 'reason'])->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent']),
        ],
    )
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-reason">Reason</label>
    <select id="contactform-reason" name="ContactForm[reason]">
        <option>Select an option</option>
        <option value="1">Sell</option>
        <option value="2">Buy</option>
        <option value="3">Rent</option>
    </select>
</div>
```

## Field with prefix

The following code shows how to create a select with a field and a prefix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Select;
?>

<?= 
    Field::widget(
        [
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->prefix('<span>Prefix</span>'),
        ],
    )
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-reason">Reason</label>
    <span>Prefix</span>
    <select id="contactform-reason" name="ContactForm[reason]">
        <option>Select an option</option>
        <option value="1">Sell</option>
        <option value="2">Buy</option>
        <option value="3">Rent</option>
    </select>
</div>
```

## Field with suffix

The following code shows how to create a select with a field and a suffix.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Select;
?>

<?= 
    Field::widget(
        [
            Select::widget([new ContactForm(), 'reason'])
                ->items([1 => 'Sell', 2 => 'Buy', 3 => 'Rent'])
                ->suffix('<span>Suffix</span>'),
        ],
    )
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-reason">Reason</label>
    <select id="contactform-reason" name="ContactForm[reason]">
        <option>Select an option</option>
        <option value="1">Sell</option>
        <option value="2">Buy</option>
        <option value="3">Rent</option>
    </select>
    <span>Suffix</span>
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
| `groups()`          | `array`       | The groups for the select.                          | `[]`    |
| `id()`              | `null,string` | The value of the HTML `id` attribute.               | `''`    |
| `items()`           | `array`       | The items for the select.                           | `[]`    |
| `multiple()`        |               | The value of the HTML `multiple` attribute.         | `false` |	
| `prefix()`          | `string`      | The prefix for the widget.                          | `''`    |
| `prompt()`          | `string`      | The prompt for the select.                          | `''`    |
| `readonly()`        |               | The value of the HTML `readonly` attribute.         | `true`  |
| `required()`        |               | The value of the HTML `required` attribute.         | `true`  |
| `size()`            | `int`         | The value of the HTML `size` attribute.             | `0`     |
| `suffix()`          | `string`      | The suffix for the widget.                          | `''`    |
| `tabindex()`        | `int`         | The value of the HTML `tabindex` attribute.         | `0`     |
| `title()`           | `string`      | The value of the HTML `title` attribute.            | `''`    |
| `value()`           | `mixed`       | The value of the HTML `value` attribute.            | `''`    |

**Note:** *You can find all the [examples](/tests/Doc/SelectDocTest.php) in the test file.*
