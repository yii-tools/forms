<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Helper\CssClass;

trait FieldLabel
{
    private array $labelAttributes = [];
    private string $labelClass = '';
    private bool $labelContainer = false;
    private array $labelContainerAttributes = [];
    private string $labelMessage = '';

    /**
     * Returns a new instance with the label attributes is an array that defines the HTML attributes of the label
     * element.
     *
     * @param array $values The Attribute values indexed by attribute names for field widget.
     */
    public function labelAttributes(array $values): static
    {
        $new = clone $this;
        $new->labelAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the label class is a string that defines the class of the label element.
     *
     * @param string $value The value of the class attribute.
     *
     * @return static
     */
    public function labelClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->labelAttributes, $value);

        return $new;
    }

    /**
     * Return new instance with container enabled or disabled for the label.
     *
     * @param bool $value True to enable container, false to disable.
     *
     * @return static
     */
    public function labelContainer(bool $value): static
    {
        $new = clone $this;
        $new->labelContainer = $value;

        return $new;
    }

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static
     */
    public function labelContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->labelContainerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with add css class to the container.
     *
     * @param string $value The css class name.
     *
     * @return static
     */
    public function labelContainerClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->labelContainerAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the label attribute value is a string that defines the text of the label element.
     *
     * @param string $value The value of the label attribute. If null, the label will not be rendered.
     *
     * @return static
     */
    public function labelContent(string $value): static
    {
        $new = clone $this;
        $new->labelMessage = $value;

        return $new;
    }
}
