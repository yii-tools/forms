<?php

declare(strict_types=1);

namespace Yii\Forms\Field\Concern;

use Yii\Html\Helper\CssClass;

/**
 * Provide methods for configuring field input container.
 */
trait HasFieldInputContainer
{
    private bool $inputContainer = false;
    private array $inputContainerAttributes = [];

    /**
     * Return new instance with input container enabled or disabled for the field.
     *
     * @param bool $value True to enable input container, false to disable.
     */
    public function inputContainer(bool $value): static
    {
        $new = clone $this;
        $new->inputContainer = $value;

        return $new;
    }

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
