<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Helper\CssClass;

/**
 * HasClass is used to add the class attribute to an element.
 */
trait HasClass
{
    /**
     * Returns a new instance with the specified class added.
     *
     * @param string $value The class value to add.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function class(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->attributes, $value);

        return $new;
    }
}
