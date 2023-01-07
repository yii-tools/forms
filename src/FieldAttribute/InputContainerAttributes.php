<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

use Yii\Html\Helper\CssClass;

trait InputContainerAttributes
{
    private array $inputContainerAttributes = [];

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function inputContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->inputContainerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with add css class to the input container.
     *
     * @param string $value The css class name.
     */
    public function inputContainerClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->inputContainerAttributes, $value);

        return $new;
    }
}
