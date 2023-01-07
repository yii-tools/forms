<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Forms\Exception\AttributeNotSet;
use Yii\Model\AbstractFormModel;
use Yiisoft\Widget\Widget;

abstract class AbstractFormWidget extends Widget
{
    use Globals;

    protected array $attributes = [];
    private string $charset = 'UTF-8';

    public function __construct(protected AbstractFormModel $formModel, protected string $attribute)
    {
        if ($this->formModel->has($this->attribute) === false) {
            throw new AttributeNotSet();
        }
    }

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     *
     * @return static
     */
    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = array_merge($this->attributes, $values);

        return $new;
    }

    /**
     * Returns a new instance specifying the character encoding of the form submission.
     *
     * @param string $value The character encoding of the form submission.
     */
    public function charset(string $value): static
    {
        $new = clone $this;
        $new->charset = $value;

        return $new;
    }

    /**
     * @return string The attribute of the widget.
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    /**
     * @return AbstractFormModel The form model of the widget.
     */
    public function getFormModel(): AbstractFormModel
    {
        return $this->formModel;
    }

    /**
     * @return string The input ID of the widget.
     */
    public function getInputId(): string
    {
        return $this->formModel->getInputId($this->attribute, $this->charset);
    }

    /**
     * @return bool Whether the widget has an error.
     */
    public function hasError(): bool
    {
        return $this->formModel->error()->has($this->attribute);
    }

    /**
     * @return bool Whether the widget is empty.
     */
    public function isEmpty(): bool
    {
        return $this->formModel->isEmpty();
    }

    /**
     * @return bool Whether the widget is valid.
     */
    public function isValidated(): bool
    {
        return !$this->isEmpty() && !$this->hasError();
    }

    /**
     * @return string The ID of the widget.
     */
    protected function getId(): string
    {
        return match (isset($this->attributes['id']) && is_string($this->attributes['id'])) {
            true => $this->attributes['id'],
            false => $this->getInputId(),
        };
    }

    public function getErrorFirstForAttribute(): string
    {
        return $this->formModel->error()->getFirst($this->attribute);
    }

    /**
     * @return string The input name of the widget.
     */
    protected function getInputName(): string
    {
        return $this->formModel->getInputName($this->attribute);
    }

    /**
     * @return string The placeholder of the widget.
     */
    protected function getPlaceholder(): string
    {
        return $this->formModel->getPlaceholder($this->attribute);
    }

    /**
     * @return mixed The value of the widget.
     */
    protected function getValue(): mixed
    {
        return $this->formModel->getAttributeValue($this->attribute);
    }
}
