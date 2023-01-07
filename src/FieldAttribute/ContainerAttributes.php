<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

use Yii\Html\Helper\CssClass;

trait ContainerAttributes
{
    private array $containerAttributes = [];

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function containerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->containerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with add css class to the container.
     *
     * @param string $value The css class name.
     */
    public function containerClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->containerAttributes, $value);

        return $new;
    }

    public function getContainerAttributes(): array
    {
        return $this->containerAttributes;
    }
}
