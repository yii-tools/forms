<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use InvalidArgumentException;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;

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

    protected function run(): string
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
            throw new InvalidArgumentException('Date::class widget must be a string or null value.');
        }

        $attributes['value'] = $value;

        return $this->renderInput('input', '', 'date', $attributes);
    }
}
