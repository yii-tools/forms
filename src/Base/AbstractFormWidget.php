<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Helper\CssClass;
use Yiisoft\Widget\Widget;

/**
 * AbstractFormWidget is the base class for widgets not related to a specific form input.
 */
abstract class AbstractFormWidget extends Widget
{
    protected array $attributes = [];

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = array_merge($this->attributes, $values);

        return $new;
    }

    /**
     * Returns a new instance with the specified the focus on the control (put cursor into it) when the page loads.
     * Only one form element could be in focus at the same time.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#autofocusing-a-form-control-the-autofocus-attribute
     */
    public function autofocus(): static
    {
        $new = clone $this;
        $new->attributes['autofocus'] = true;

        return $new;
    }

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

    /**
     * Returns a new instance with the specified the ID of the widget.
     *
     * @param string|null $id The ID of the widget.
     *
     * @link https://html.spec.whatwg.org/multipage/dom.html#the-id-attribute
     */
    public function id(string|null $id): static
    {
        $new = clone $this;
        $new->attributes['id'] = $id;

        return $new;
    }

    /**
     * Returns a new instance with the specified the name part of the name/value pair associated with this element for
     * the purposes of form submission.
     *
     * @param string|null $value The name of the widget.
     *
     * @link https://html.spec.whatwg.org/multipage/form-control-infrastructure.html#attr-fe-name
     */
    public function name(string|null $value): static
    {
        $new = clone $this;
        $new->attributes['name'] = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified the tabindex global attribute indicates that its element can be
     * focused, and where it participates in sequential keyboard navigation (usually with the Tab key, hence the name).
     *
     * It accepts an integer as a value, with different results depending on the integer's value:
     *
     * - A negative value (usually `tabindex="-1"`) means that the element is not reachable via sequential keyboard
     * navigation, but could be focused with Javascript or visually. It's mostly useful to create accessible widgets
     * with JavaScript.
     *
     * - `tabindex="0"` means that the element should be focusable in sequential keyboard navigation, but its order is
     * defined by the document's source order.
     *
     * - A positive value means the element should be focusable in sequential keyboard navigation, with its order
     * defined by the value of the number. That is, tabindex="4" is focused before tabindex="5", but after tabindex="3".
     *
     * @param int $value The tabindex value.
     *
     * @link https://html.spec.whatwg.org/multipage/interaction.html#attr-tabindex
     */
    public function tabIndex(int $value): static
    {
        $new = clone $this;
        $new->attributes['tabindex'] = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified the title global attribute contains text representing advisory
     * information related to the element it belongs to.
     *
     * @param string $value The title of the widget.
     *
     * @link https://html.spec.whatwg.org/multipage/dom.html#attr-title
     */
    public function title(string $value): static
    {
        $new = clone $this;
        $new->attributes['title'] = $value;

        return $new;
    }

    /**
     * Returns a new instance with the specified the value content attribute gives the default value of the field.
     *
     * @param mixed $value The value of the widget.
     *
     * @link https://html.spec.whatwg.org/multipage/input.html#attr-input-value
     */
    public function value(mixed $value): static
    {
        $new = clone $this;
        $new->attributes['value'] = $value;

        return $new;
    }
}
