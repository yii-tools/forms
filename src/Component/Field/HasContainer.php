<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

use Yii\Html\Helper\CssClass;

/**
 * Trait HasContainer provides methods to configure the HTML container of the field.
 */
trait HasContainer
{
    private bool $container = true;
    private array $containerAttributes = [];

    /**
     * Return new instance with container enabled or disabled for the field.
     *
     * @param bool $value True to enable container, false to disable.
     */
    public function container(bool $value): static
    {
        $new = clone $this;
        $new->container = $value;

        return $new;
    }

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

    /**
     * Returns container attribute value.
     */
    private function getContainerAttributes(): array
    {
        return $this->containerAttributes;
    }
}
