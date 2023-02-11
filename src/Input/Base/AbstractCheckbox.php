<?php

declare(strict_types=1);

namespace Yii\Forms\Input\Base;

use Yii\Forms\Input\Hidden;
use Yii\Widget\Attribute\CanBeChecked;
use Yii\Widget\Input\AbstractInputWidget;

abstract class AbstractCheckbox extends AbstractInputWidget
{
    use CanBeChecked;

    protected Hidden|null $hidden = null;
    protected null|string $label = '';
    protected array $labelAttributes = [];
    protected bool $verticalAlignment = false;
    protected array $verticalAlignmentAttributes = [];

    /**
     * Returns a new instance with hidden widget that corresponds to "unchecked" state of the input.
     *
     * @param string $value The value of the "unchecked" state.
     * @param array $values The Attribute values indexed by attribute names for hidden widget.
     */
    public function hidden(string $value, array $values = []): static
    {
        $new = clone $this;
        $new->hidden = Hidden::widget([$this->formModel, $this->attribute])->attributes($values)->value($value);

        return $new;
    }

    /**
     * Returns a new instance specifying the label of checkbox.
     *
     * @param string $value The label of checkbox.
     */
    public function label(string $value): static
    {
        $new = clone $this;
        $new->label = $value;

        return $new;
    }

    /**
     * Return a new instance specifying the attributes for label.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function labelAttributes(array $values): static
    {
        $new = clone $this;
        $new->labelAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance specifying whether the label not to be displayed.
     */
    public function notLabel(): static
    {
        $new = clone $this;
        $new->label = null;

        return $new;
    }

    /**
     * Returns a new instance specifying whether the label to be displayed in the same line.
     *
     * @param bool $value Whether the label to be displayed in the same line.
     */
    public function verticalAlignment(): static
    {
        $new = clone $this;
        $new->verticalAlignment = true;

        return $new;
    }

    /**
     * Return a new instance specifying the attributes for inline label.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function verticalAlignmentAttributes(array $values): static
    {
        $new = clone $this;
        $new->verticalAlignmentAttributes = $values;

        return $new;
    }
}
