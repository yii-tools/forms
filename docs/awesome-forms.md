# Forms

Awesome forms for YiiFramework v.3.0 provides a set of classes to create forms in a simple way.

## Creating a form model

To create a form, you need to create a class that extends the `AbstractFormModel::class`. The `AbstractFormModel::class` give a set of methods to create a form.

```php
<?php

declare(strict_types=1);

namespace App\Form\Contact;

use Yii\FormModel\AbstractFormModel;

final class ContactForm extends AbstractFormModel
{
    private array $attachment = [];
    private string $email = '';
    private string $message = '';
    private string $name = '';
    private string $subject = '';
}
```
## Component widget

- [Button group](/docs/component/button-group.md)
- [CheckboxList](/docs/component/checkboxlist.md)
- [Field](/docs/component/field.md)
    - [Elements](/docs/component/field.md#elements)
    - [Container](/docs/component/field.md#container)
    - [Prefix](/docs/component/field.md#prefix)
    - [Label](/docs/field/label.md)    
    - [Suffix](/docs/component/field.md#prefix)
    - [Hint](/docs/field/hint.md)
    - [Error](/docs/field/error.md)
    - [Invalid class](/docs/component/field.md#invalid-class)
    - [Valid class](/docs/component/field.md#valid-class)
    - [Template](/docs/component/field.md#template)
    - [Input template](/docs/component/field.md#input-template)

## Input widget

- [Button](/docs/input/button.md)
- [Checkbox](/docs/input/checkbox.md)
- [Date](/docs/input/date.md)
- [File](/docs/input/file.md)
- [Hidden](/docs/input/hidden.md)
- [Text](/docs/input/text.md)
