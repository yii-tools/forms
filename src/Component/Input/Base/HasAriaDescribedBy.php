<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

/**
 * HasAriaDescribedBy is used by elements that have an aria-describedby attribute.
 */
trait HasAriaDescribedBy
{
    /**
     * Returns a new instance with identifies the element (or elements) that describes the element on which the
     * attribute is set.
     *
     * @param bool|string $value The value of the aria-describedby attribute.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Attributes/aria-describedby
     */
    public function ariaDescribedBy(bool|string $value): static
    {
        $new = clone $this;
        $new->attributes['aria-describedby'] = $value;

        return $new;
    }
}
