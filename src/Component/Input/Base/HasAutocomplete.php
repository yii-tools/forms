<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

use InvalidArgumentException;

/**
 * HasAutocomplete is used by elements that have an autocomplete attribute.
 */
trait HasAutocomplete
{
    /**
     * Returns a new instance specifies whether the element represents an input control for which a UA is meant to store
     * the value entered by the user (so that the UA can prefill the form later).
     *
     * @param string $value Whether the element represents an input control for which a UA is meant to store
     * the value entered by the user (so that the UA can prefill the form later).
     *
     * @link https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#attr-fe-autocomplete
     */
    public function autocomplete(string $value): static
    {
        if ($value !== 'on' && $value !== 'off') {
            throw new InvalidArgumentException('Autocomplete must be "on" or "off".');
        }

        $new = clone $this;
        $new->attributes['autocomplete'] = $value;

        return $new;
    }
}
