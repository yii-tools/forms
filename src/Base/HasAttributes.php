<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use function array_merge;

/**
 * HasAttributes is used by elements that have an attributes attribute.
 *
 * @link https://www.w3.org/TR/html52/dom.html#global-attributes
 * @link https://developer.mozilla.org/en-US/docs/Web/HTML/Attributes
 */
trait HasAttributes
{
    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = array_merge($this->attributes, $values);

        return $new;
    }
}
