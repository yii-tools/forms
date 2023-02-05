<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use InvalidArgumentException;
use Yii\Html\Helper\Utils;
use Yii\Widget\Input\AbstractInputWidget;
use Yii\Widget\Attribute;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "text" represents a one-line plain text edit control for the
 * input element’s value.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.text.html#input.text
 */
final class Text extends AbstractInputWidget
{
    use Attribute\HasDirname;
    use Attribute\HasMaxLength;
    use Attribute\HasMinLength;
    use Attribute\HasPattern;
    use Attribute\HasPlaceholder;
    use Attribute\HasSize;

    public function render(): string
    {
        $attributes = $this->attributes;
        $value = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue() === '' ? null : $this->getValue(),
        };

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.text.html#input.text.attrs.value
         */
        if ($value !== null && !is_string($value)) {
            throw new InvalidArgumentException(
                Utils::shortNameClass(self::class) . ' widget must be a string or null value.',
            );
        }

        $attributes['value'] = $value;
        $placeHolder = $this->getPlaceHolder();

        if (!array_key_exists('placeholder', $attributes) && $placeHolder !== '') {
            $attributes['placeholder'] = $placeHolder;
        }

        return $this->run('input', '', 'text', $attributes);
    }
}
