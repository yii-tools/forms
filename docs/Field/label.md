# Label

For default the label its the attribute label of the form model, which can be changed by the `\Yii\Forms\Field::labelContent()` method.

For example, the following code for change the label content.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->labelContent('User name:') ?>
```

That would generate the following code:

```html
<div>
	<label for="contactform-name">User name:</label>
	<input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

**Note:** The label content is for default encoded, which can be disabled by the `\Yii\Forms\Field::labelEncode()` method, which we do not recommend for security reasons.

For example, the following code for closure label content.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?=            
    Field::widget([Text::widget([new ContactForm(), 'name'])])
        ->labelClosure(
            static fn (ContactForm $formModel) => '<label>' . $formModel->getLabel('name') . ': </label>'
        )
?>
```

That would generate the following code:

```html
<div>
    <label>Name: </label>
	<input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

for example, the following code for add attribute `HTML class` to the label.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->labelClass('form-label') ?>
```

That would generate the following code:

```html
<div>
    <label class="form-label" for="contactform-name">Name</label>
	<input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

Or the following code for add attribute to the label.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->labelAttributes(['data-test' => 'test']) ?>
```

That would generate the following code:

```html
<div>
	<label for="contactform-name" data-test="test">Name</label>
	<input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```

To finish you can also disable the label by the `\Yii\Forms\Field::notLabel()` method.

For example, the following code for disable the label.

```php
<?php

declare(strict_types=1);

use App\Form\ContactForm;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
?>

<?= Field::widget([Text::widget([new ContactForm(), 'name'])])->notLabel() ?>
```

That would generate the following code:

```html
<div>
	<input id="contactform-name" name="ContactForm[name]" type="text">
</div>
```
