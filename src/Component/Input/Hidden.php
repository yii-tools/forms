<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use InvalidArgumentException;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Html\Attribute;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "hidden" represents a value that is not intended to be
 * examined or manipulated by the user.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.hidden.html#input.hidden.attrs.value
 */
final class Hidden extends AbstractFormWidget
{
    use Attribute\Disabled;
    use Attribute\Form;
    use Attribute\Value;

    /**
     * @return string the generated input tag.
     */
    public function render(): string
    {
        $attributes = $this->attributes;

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        }

        if (!array_key_exists('name', $attributes)) {
            $attributes['name'] = Utils::generateInputName($this->formModel->getFormName(), $this->attribute);
        }

        $value = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue() === '' ? null : $this->getValue(),
        };

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.hidden.html#input.hidden.attrs.value
         */
        if (null !== $value && !is_string($value)) {
            throw new InvalidArgumentException(
                Utils::shortNameClass(self::class) . ' widget must be a string or null value.',
            );
        }

        $attributes['type'] = 'hidden';
        $attributes['value'] = $value;

        return Tag::create('input', '', $attributes);
    }
}
