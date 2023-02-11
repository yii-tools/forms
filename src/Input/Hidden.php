<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use InvalidArgumentException;
use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "hidden" represents a value that is not intended to be
 * examined or manipulated by the user.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.hidden.html#input.hidden.attrs.value
 */
final class Hidden extends AbstractInputWidget
{
    /**
     * @return string the generated input tag.
     */
    public function render(): string
    {
        $attributes = $this->attributes;

        $value = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue() === '' ? null : $this->getValue(),
        };

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.hidden.html#input.hidden.attrs.value
         */
        if (null !== $value && !is_string($value)) {
            throw new InvalidArgumentException('Hidden::class widget must be a string or null value.');
        }

        $attributes['value'] = $value;

        return $this->run('input', '', 'hidden', $attributes);
    }
}
