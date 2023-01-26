<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

/**
 * HasId is used to set the id attribute value of an element.
 */
trait HasId
{
    /**
     * Returns a new instance with the specified the ID of the widget.
     *
     * @param string|null $id The ID of the widget.
     *
     * @link https://html.spec.whatwg.org/multipage/dom.html#the-id-attribute
     */
    public function id(string|null $id): static
    {
        $new = clone $this;
        $new->attributes['id'] = $id;

        return $new;
    }
}
