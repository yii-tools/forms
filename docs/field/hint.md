# Hint

For default the hint it's the attribute hint of the form model, which can be changed by the `\Yii\Forms\Field::hintContent()` method.

## Attributes

The following code shows how to create a field with hint attributes.

```php
<?php

declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new TestForm(), 'string'])])->hintAttributes(['data-test' => 'test']) ?>
```

That would generate the following code:

```html
<div>
    <label for="testform-string">String</label>
    <input id="testform-string" name="TestForm[string]" type="text">
    <div data-test="test">
        String hint
    </div>
</div>
```

## Class

The following code shows how to create a field with hint class.

```php
<?php

declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new TestForm(), 'string'])])->hintClass('form-hint') ?>
```

That would generate the following code:

```html
<div>
    <label for="testform-string">String</label>
    <input id="testform-string" name="TestForm[string]" type="text">
    <div class="form-hint">
        String hint
    </div>
</div>
```

## Closure

The following code shows how to create a field with hint closure.

```php
<?php

declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=            
    Field::widget([Text::widget([new TestForm(), 'string'])])
        ->hintClosure(
            static fn (TestForm $formModel) => '<div>' . $formModel->getHint('string') . '</div>'
        )
?>
```

That would generate the following code:

```html
<div>
    <label for="testform-string">String</label>
    <input id="testform-string" name="TestForm[string]" type="text">
    <div>
        String hint
    </div>
</div>
```

## Content

The following code shows how to create a field with hint content.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->hintContent('Enter your name') ?>
```

That would generate the following code:

```html
<div>
    <label for="contactform-name">Name</label>
    <input id="contactform-name" name="ContactForm[name]" type="text">
    <div>
        Enter your name
    </div>
</div>
```

## Tag

The following code shows how to create a field with hint tag.

```php
<?php

declare(strict_types=1);

use App\Form\TestForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new TestForm(), 'string'])])->hintTag('span') ?>
```

That would generate the following code:

```html
<div>
    <label for="testform-string">String</label>
    <input id="testform-string" name="TestForm[string]" type="text">
    <span>String hint</span>
</div>
```

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method              | Parameter     | Description                                  | Default    |
|---------------------|---------------|----------------------------------------------|------------|
| `hintAttribute()`   | `array`       | The HTML attributes for the container tag.   | `[]`       |
| `hintClass()`       | `string`      | The HTML class for the container tag.        | `''`       |
| `hintClosure()`     | `Closure`     | The closure that returns the content.        | `null`     |
| `hintContent()`     | `string`      | The content.                                 | `''`       |	
| `hintTag()`         | `string`      | The tag name.                                | `div`      |

**Note:** *You can find all the [examples](/tests/Doc/HintDocTest.php) in the test file.*
