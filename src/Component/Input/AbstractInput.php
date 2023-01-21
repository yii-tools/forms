<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use Yii\Forms\Base\AbstractFormWidget;
use Yii\Html\Attribute;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;

use function array_key_exists;

/**
 * The input element represents a typed data field, usually with a form control to allow the user to edit the data.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.html
 */
abstract class AbstractInput extends AbstractFormWidget
{
    use Attribute\CanBeDisabled;
    use Attribute\CanBeReadonly;
    use Attribute\CanBeRequired;
    use Attribute\HasAriaDescribedBy;
    use Attribute\HasAriaLabel;
    use Attribute\HasAutocomplete;
    use Attribute\HasForm;
    use Attribute\HasLists;
    use Attribute\HasValue;

    protected function input(string $type, array $attributes): string
    {
        $attributes['type'] = $type;

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        }

        if (!array_key_exists('name', $attributes)) {
            $attributes['name'] = Utils::generateInputName($this->formModel->getFormName(), $this->attribute);
        }

        return Tag::create('input', '', $attributes);
    }
}
