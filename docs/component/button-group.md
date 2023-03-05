# Button group

It's a part which can be used to create a set of buttons that are related to each other.

This is a wrapper for the [Button](/docs/input/button.md) widget.

## Example

```php
<?php

declare(strict_types=1);

use Yii\Forms\ButtonGroup;
?>

<?= ButtonGroup::widget()->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']]) ?>
```

That would generate the following code:

```html
<div>
    <input type="Submit" value="Submit">
    <input type="Reset" value="Reset">
</div>
```

## Example with button widget

```php
<?php

declare(strict_types=1);

use Yii\Forms\ButtonGroup;
use Yii\Forms\Input\Button;
?>

<?= ButtonGroup::widget()->buttons([Button::widget()->type('submit'), Button::widget()->type('reset')]) ?>
```

That would generate the following code:

```html
<div>
    <input type="submit">
    <input type="reset">
</div>
```

## Example with Field

```php
<?php

declare(strict_types=1);

use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
?>

<?  Field::widget([ButtonGroup::widget()->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']])]) ?>
```

That would generate the following code:

```html
<div>
    <div>
        <input type="Submit" value="Submit">
        <input type="Reset" value="Reset">
    </div>
</div>
```

## Example with Field and button widget

```php
<?php

declare(strict_types=1);

use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
?>

<?  Field::widget([ButtonGroup::widget()->buttons([Button::widget()->type('submit'), Button::widget()->type('reset')])]) ?>
```

That would generate the following code:

```html
<div>
    <div>
        <input type="submit">
        <input type="reset">
    </div>
</div>
```

## Methods of the widget

All methods are immutable, which means that they will return a new instance of the widget with the specified option set.

| Method                         | Parameter | Description                                     | Default |
|--------------------------------|-----------|-------------------------------------------------|---------|
| `buttons()`                    | `array`   | The buttons to be rendered.                     | `[]`	   |
| `container()`                  | `bool`    | The container for the widget.                   | `false` |
| `containerAttributes()`        | `array`   | The HTML attributes for the container.          | `[]`    |
| `containerClass()`             | `string`  | The HTML class for the container.               | `''`    |
| `individualButtonAttributes()` | `array`   | The HTML attributes for the individual buttons. | `[]`    |

**Note:** *You can find all the [examples](/tests/Doc/ButtonGroupDocTest.php) in the test file.*
