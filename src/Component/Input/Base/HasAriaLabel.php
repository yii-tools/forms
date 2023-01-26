<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

/**
 * HasAriaLabel is used by elements that have an aria-label attribute.
 */
trait HasAriaLabel
{
    /**
     * Returns a new instance with a string value that labels an interactive element.
     *
     * @param string $value The value of the aria-label attribute.
     *
     * @link https://developer.mozilla.org/en-US/docs/Web/Accessibility/ARIA/Attributes/aria-label
     */
    public function ariaLabel(string $value): static
    {
        $new = clone $this;
        $new->attributes['aria-label'] = $value;

        return $new;
    }
}
