<?php

declare(strict_types=1);

namespace Yii\Forms\Input\Base;

use Yii\Forms\Input\Hidden;
use Yii\Html\Helper\CssClass;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;

abstract class AbstractCheckbox extends AbstractInputWidget
{
    use Attribute\CanBeChecked;
    use Attribute\HasLabel;

    protected bool $container = false;
    protected array $containerAttributes = [];
    protected Hidden|null $unchecked = null;

    /**
     * Return new instance with container enabled or disabled.
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
     * Returns a new instance with hidden widget that corresponds to "unchecked" state of the input.
     *
     * @param string $value The value of the "unchecked" state.
     * @param array $values The Attribute values indexed by attribute names for hidden widget.
     */
    public function unchecked(string $value, array $values = []): static
    {
        $new = clone $this;
        $new->unchecked = Hidden::widget([$this->formModel, $this->attribute])->attributes($values)->value($value);

        return $new;
    }
}
