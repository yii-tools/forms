<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Helper\CssClass;

trait FieldHint
{
    private array $hintAttributes = [];
    private string $hintClass = '';
    private bool $hintContainer = false;
    private array $hintContainerAttributes = [];
    private string $hintMessage = '';
    private string $hintTag = 'div';

    /**
     * Returns a new instance with the hint attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function hintAttributes(array $values): static
    {
        $new = clone $this;
        $new->hintAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the hint css class.
     *
     * @param string $value The hint class.
     */
    public function hintClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->hintAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the hint container enabled or disabled.
     *
     * @param bool $value `true` to enable the hint container, `false` to disable it.
     */
    public function hintContainer(bool $value): static
    {
        $new = clone $this;
        $new->hintContainer = $value;

        return $new;
    }

    /**
     * Returns a new instance with the HTML container attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function hintContainerAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->hintContainerAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with add css class to the container.
     *
     * @param string $value The css class name.
     */
    public function hintContainerClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->hintContainerAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the hint text.
     *
     * @param string $value The hint message. If null, the hint will be removed.
     */
    public function hintMessage(string $value): self
    {
        $new = clone $this;
        $new->hintMessage = $value;

        return $new;
    }

    /**
     * Returns a new instance with the hint tag name.
     *
     * @param string $value The hint tag name.
     */
    public function hintTag(string $value): static
    {
        $new = clone $this;
        $new->hintTag = $value;

        return $new;
    }
}
