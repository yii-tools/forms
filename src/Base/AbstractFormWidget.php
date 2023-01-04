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

    protected function getId(): string
    {
        return match (isset($this->attributes['id']) && is_string($this->attributes['id'])) {
            true => $this->attributes['id'],
            false => $this->getInputId(),
        };
    }

    protected function getInputId(): string
    {
        return $this->formModel->getInputId($this->attribute, $this->charset);
    }

    protected function getInputName(): string
    {
        return $this->formModel->getInputName($this->attribute);
    }

    protected function getPlaceholder(): string
    {
        return $this->formModel->getPlaceholder($this->attribute);
    }

    protected function getValue(): mixed
    {
        return $this->formModel->getAttributeValue($this->attribute);
    }
}
