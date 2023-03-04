# Hint

For default the hint its the attribute hint of the form model, which can be changed by the `\Yii\Forms\Field::hintContent()` method.

For example, the following code for change the hint content.

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

For example, the following code for closure hint content.

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

for example, the following code for add attribute `HTML class` to the hint.

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

Or the following code for add attribute to the hint.

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

To finish you can also change tag of the hint by the `\Yii\Forms\Field::hintTag()` method.

For example, the following code for change the tag of the hint.

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
