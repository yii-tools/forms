## Button widget

[button](https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button) is an input element with a type attribute whose value is `button`, `submit` or `reset`, representing a button labeled by its contents.

### Example

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

### Example type submit

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

### Example type reset

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

### Example with value

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Input\Button;
?>

<?= Button::widget()->value('Click me')->render() ?>
```

That would generate the following code:

```html
<input type="button" value="Click me">
```

### Example with Field

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
?>

<?= Field::widget([Button::widget()])->render(), ?>
```

That would generate the following code:

```html
<div>
    <input type="button">
</div>
```
