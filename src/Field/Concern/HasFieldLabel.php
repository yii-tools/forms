<?php

declare(strict_types=1);

namespace Yii\Forms\Field\Concern;

use Closure;
use Yii\Html\Helper\CssClass;

/**
 * Provides methods for configuring field label.
 */
trait HasFieldLabel
{
    private array $labelAttributes = [];
    private string $labelClass = '';
    private Closure|null $labelClosure = null;
    private string $labelContent = '';
    private bool $labelEncode = true;
    private bool $notLabel = false;

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
     */
    public function labelClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->labelAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the label closure.
     *
     * @param Closure $value The label closure.
     */
    public function labelClosure(Closure $value): static
    {
        $new = clone $this;
        $new->labelClosure = $value;

        return $new;
    }

    /**
     * Returns a new instance with the label attribute value is a string that defines the text of the label element.
     *
     * @param string $value The value of the label attribute. If null, the label will not be rendered.
     */
    public function labelContent(string $value): static
    {
        $new = clone $this;
        $new->labelContent = $value;

        return $new;
    }

    /**
     * Returns a new instance with the value indicating whether the label should be HTML-encoded.
     *
     * @param bool $value The value indicating whether the label should be HTML-encoded.
     */
    public function labelEncode(bool $value): static
    {
        $new = clone $this;
        $new->labelEncode = $value;

        return $new;
    }

    /**
     * Returns a new instance where the label is not rendered.
     */
    public function notLabel(): static
    {
        $new = clone $this;
        $new->notLabel = true;

        return $new;
    }

    /**
     * Returns a new instance whether the label is rendered.
     */
    private function isLabel(): bool
    {
        return !$this->notLabel;
    }
}
