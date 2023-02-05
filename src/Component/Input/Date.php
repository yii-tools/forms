<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use InvalidArgumentException;
use Yii\Html\Helper\Utils;
use Yii\Widget\Attribute;
use Yii\Widget\Input\AbstractInputWidget;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "date" represents a control for setting the element’s value
 * to a string representing a date.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.date.html#input.date
 */
final class Date extends AbstractInputWidget
{
    use Attribute\HasMax;
    use Attribute\HasMin;
    use Attribute\HasStep;

    public function render(): string
    {
        $attributes = $this->attributes;
        $value = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue() === '' ? null : $this->getValue(),
        };

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.date.html#input.date.attrs.value
         */
        if ($value !== null && !is_string($value)) {
            throw new InvalidArgumentException(
                Utils::shortNameClass(self::class) . ' widget must be a string or null value.',
            );
        }

        $attributes['value'] = $value;

        return $this->run('input', '', 'date', $attributes);
    }
}
