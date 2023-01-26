<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

/**
 * HasPattern is used to set the pattern attribute value for an element.
 */
trait HasPattern
{
    /**
     * Returns a new instance with the pattern attribute, when specified, is a regular expression that the input's
     * value must match in order for the value to pass constraint validation. It must be a valid JavaScript regular
     * expression, as used by the RegExp type.
     *
     * @param string $value The pattern value to be used.
     *
     * @link https://html.spec.whatwg.org/multipage/input.html#the-pattern-attribute
     */
    public function pattern(string $value): static
    {
        $new = clone $this;
        $new->attributes['pattern'] = $value;

        return $new;
    }
}
