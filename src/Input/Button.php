<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use InvalidArgumentException;
use Yii\Html\Tag;
use Yii\Widget\Attribute;
use Yii\Widget\Component\AbstractComponentWidget;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "button" represents a button with no additional semantics.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button
 */
final class Button extends AbstractComponentWidget
{
    use Attribute\CanBeDisabled;
    use Attribute\HasForm;
    use Attribute\HasType;

    public function render(): string
    {
        $attributes = $this->attributes;
        $value = $attributes['value'] ?? null;

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button.attrs.value
         */
        if (null !== $value && !is_string($value)) {
            throw new InvalidArgumentException('Button::class widget must be a string or null value.');
        }

        if (!array_key_exists('type', $attributes)) {
            $attributes['type'] = 'button';
        }

        $attributes['value'] = $value;

        return Tag::create('input', '', $attributes);
    }
}
