<?php

declare(strict_types=1);

namespace Yii\Forms\Widget;

use InvalidArgumentException;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Html\Tag;
use Yii\Model\AbstractFormModel;
use Yiisoft\Widget\Widget;
use Stringable;

/**
 * The Hint widget generates a hint message for the specified model attribute.
 */
final class Hint extends Widget
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
     * Returns a new instance with the hint text.
     *
     * @param string $value The hint text.
     *
     * @return self
     */
    public function message(string $value): self
    {
        $new = clone $this;
        $new->message = $value;

        return $new;
    }

    /**
     * Returns a new instance with the container tag name for the hint.
     *
     * @param string $value The container tag name.
     *
     * @return self
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
            $message = $this->formModel->getHint($this->attribute);
        }

        return match ($message !== '') {
            true => Tag::create($this->tag, $message, $this->attributes),
            default => '',
        };
    }
}
