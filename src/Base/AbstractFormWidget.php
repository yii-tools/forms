<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\FormModelInterface;
use Yii\Html\Helper\Utils;
use Yiisoft\Widget\Widget;

use function array_merge;
use function is_string;

abstract class AbstractFormWidget extends Widget
{
    use Globals;

    protected array $attributes = [];
    private string $charset = 'UTF-8';

    public function __construct(protected FormModelInterface $formModel, protected string $attribute)
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
     * @return FormModelInterface The form model of the widget.
     */
    public function getFormModel(): FormModelInterface
    {
        return $this->formModel;
    }

    /**
     * @return string The ID of the widget.
     */
    public function getId(): string
    {
        return match (isset($this->attributes['id']) && is_string($this->attributes['id'])) {
            true => $this->attributes['id'],
            false => Utils::generateInputId($this->formModel->getFormName(), $this->attribute),
        };
    }

    /**
     * @return bool Whether the widget is valid.
     */
    public function isValidated(): bool
    {
        return !$this->isEmpty() && !$this->hasError();
    }

    /**
     * @return bool Whether the widget has an error.
     */
    public function hasError(): bool
    {
        return $this->formModel->hasError($this->attribute);
    }

    public function getErrorFirstForAttribute(): string
    {
        return $this->formModel->getFirstError($this->attribute);
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

    /**
     * @return bool Whether the widget is empty.
     */
    private function isEmpty(): bool
    {
        return $this->formModel->isEmpty();
    }
}
