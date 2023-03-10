# Error

It allows us to obtain the errors by attributes from a form model and show them in the field.

For default, the error, it's checked by:

- `\Yii\FormModel\FormModelInterface:getFirstError()`: Show only the first error of the specified attribute.
- `\Yii\FormModel\FormModelInterface:getError()`. Show all errors of the specified attribute.

## Content

The following code shows how to set the error content.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->errorContent('This is a custom error message.') ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <div>
        This is a custom error message.
    </div>
</div>
```

## Closure

The following code shows how to set the error content with a `Closure`.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=
    Field::widget([Text::widget([$formModel, 'name'])])
        ->errorClosure(
            static fn (ContactForm $formModel) => $formModel->hasError('name')
                ? sprintf('This is a custom error message for %s.', $formModel->getAttributeLabel('name'))
                : '<div>Not error found.</div>'
        )
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <div>Not error found.</div>
</div>
```

## Class

The following code show error with attribute `HTML class`.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=
    Field::widget([Text::widget([new ContactForm(), 'name'])])
        ->errorClass('test-class')
        ->errorContent('This is a custom error message.')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <div class="test-class">
        This is a custom error message.
    </div>
</div>
```

## Attributes

The following code show error with attribute `HTML attributes`.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=
    Field::widget([Text::widget([new ContactForm(), 'name'])])
        ->errorAttributes(['data-test' => 'test'])
        ->errorContent('This is a custom error message.')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <div data-test="test">
        This is a custom error message.
    </div>
</div>
```

## Tag

The following code shows hint with container tag.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=
    Field::widget([Text::widget([new ContactForm(), 'name'])])
        ->errorContent('This is a custom error message.')
        ->errorTag('p')
?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <p>
        This is a custom error message.
    </p>
</div>
```

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method              | Parameter     | Description                                  | Default    |
|---------------------|---------------|----------------------------------------------|------------|
| `errorAttributes()` | `array`       | The HTML attributes for the container tag.   | `[]`       |
| `errorClass()`      | `string`      | The HTML class for the container tag.        | `''`       |
| `errorClosure()`    | `Closure`     | The closure that returns the content.        | `null`     |
| `errorContent()`    | `string`      | The content.                                 | `''`       |	
| `errortag()`        | `string`      | The tag name.                                | `div`      |
| `showAllErrors()`   | `bool`        | Show all errors.                             | `false`    |

**Note:** *You can find all the [examples](/tests/Doc/ErrorDocTest.php) in the test file.*
