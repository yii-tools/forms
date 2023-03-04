# Forms

Awesome forms for YiiFramework v.3.0. provides a set of classes to create forms in a simple way.

For default widgets provide 2 levels of configuration in `widget.php` file for the factory, `Widget::widget(config: $config);` for the widget. The first level is the default configuration for the widget, the second level is the configuration for the widget instance. The second level is used to override the first level.

## Creating a form model

To create a form, you need to create a class that extends the `AbstractFormModel::class`. The `AbstractFormModel::class` provide a set of methods to create a form.

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
- [Checkboxlist](/docs/component/checkboxlist.md)
- [Field](/docs/component/field.md)
    - [Structure](/docs/component/field.md#structure)
    - [Container](/docs/component/field.md#container)
    - [Prefix](/docs/component/field.md#prefix)
    - [Label](/docs/field/label.md)    
    - [Suffix](/docs/component/field.md#prefix)
    - [Hint](/docs/field/hint.md)
    - [Error](/docs/field/error.md)
    - [Invalid class](/docs/field.md#invalid-class)
    - [Valid class](/docs/field.md#valid-class)
    - [Template](/docs/field.md#template)
    - [Input template](/docs/field.md#input-template)
- [Form](/docs/form.md)
- [Textarea](/docs/textarea.md)

## Input widget

- [Button](/docs/input/button.md)
- [Checkbox](/docs/input/checkbox.md)
- [Date](/docs/input/date.md)
- [File](/docs/input/file.md)
- [Hidden](/docs/input/hidden.md)
- [Text](/docs/input/text.md)
