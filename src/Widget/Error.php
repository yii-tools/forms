<?php

declare(strict_types=1);

namespace Yii\Forms\Widget;

use InvalidArgumentException;
use Stringable;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Html\Tag;
use Yii\Model\AbstractFormModel;
use Yiisoft\Widget\Widget;

/**
 * The Error widget generates an error message for the specified model attribute.
 */
final class Error extends Widget
{
    private array $attributes = [];
    private string $message = '';
    private string $tag = 'div';

    public function __construct(private AbstractFormModel $formModel, private string $attribute = '')
    {
        if ($this->formModel->has($this->attribute) === false) {
            throw new AttributeNotSet();
        }
    }

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function attributes(array $values): static
    {
        $new = clone $this;
        $new->attributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with callback that will be called to obtain an error message.
     *
     * The signature of the callback must be:
     *
     * ```php
     * [$FormModel, function()]
     * ```
     *
     * @param array $value The callback that will be called to obtain an error message.
     */
    public function callback(array $value): self
    {
        $new = clone $this;
        $new->message = (string) $value($this->formModel, $this->attribute);

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * @param string $value The error text.
     */
    public function message(string $value): self
    {
        $new = clone $this;
        $new->message = $value;

        return $new;
    }

    /**
     * Returns a new instance with the container tag name for the error.
     *
     * @param string $value The container tag name.
     */
    public function tag(string $value): self
    {
        $new = clone $this;
        $new->tag = $value;

        return $new;
    }

    public function render(): string|Stringable
    {
        $message = $this->message;

        if ($this->tag === '') {
            throw new InvalidArgumentException('Tag name cannot be empty.');
        }

        if ($message === '') {
            $message = $this->formModel->error()->getFirst($this->attribute);
        }

        return match ($message !== '') {
            true => Tag::create($this->tag, $message, $this->attributes),
            default => '',
        };
    }
}
