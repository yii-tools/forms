<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input\Base;

use InvalidArgumentException;

/**
 * HasList is used to set the value of the id attribute on the datalist with which to associate the element.
 */
trait HasLists
{
    /**
     * Returns a new instance with the value of the id attribute on the datalist with which to associate the element.
     *
     * @param string $value The value of the id attribute on the datalist with which to associate the element.
     *
     * @link https://html.spec.whatwg.org/multipage/input.html#attr-input-list
     */
    public function list(string $value): static
    {
        if ($value === '') {
            throw new InvalidArgumentException('The value cannot be empty.');
        }

        $new = clone $this;
        $new->attributes['list'] = $value;

        return $new;
    }
}
