<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

/**
 * HasMax is used by elements that have a max attribute such as input.
 */
trait HasMax
{
    /**
     * Returns a new instance with the maximum value.
     *
     * @param int|string $value The maximum value.
     *
     * @link https://html.spec.whatwg.org/multipage/input.html#attr-input-max
     */
    public function max(int|string $value): static
    {
        $new = clone $this;
        $new->attributes['max'] = $value;

        return $new;
    }
}
