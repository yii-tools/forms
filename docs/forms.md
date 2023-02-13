## Using forms

Awesome forms for YiiFramework v.3.0. provides a set of classes to create forms in a simple way.

For default widgets provide 2 levels of configuration in `widget.php` file for the factory, `Widget::widget(config: $config);` for the widget. The first level is the default configuration for the widget, the second level is the configuration for the widget instance. The second level is used to override the first level.

### Creating a Form Model

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

### Using widgets

- [Checkbox](/docs/checkbox.md)

