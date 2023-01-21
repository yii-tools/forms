<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Closure;
use InvalidArgumentException;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\FormModelInterface;
use Yii\Html\Tag;
use Yiisoft\Widget\Widget;

/**
 * The Error widget generates an error content for the specified model attribute.
 */
final class Error extends Widget
{
    private array $attributes = [];
    private Closure|null $closure = null;
    private string $content = '';
    private string $tag = 'div';

    public function __construct(private readonly FormModelInterface $formModel, private readonly string $attribute = '')
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
    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with closure that will be called to obtain an error content.
     *
     * @param Closure $value The closure that will be called to obtain an error content.
     */
    public function closure(Closure $value): self
    {
        $new = clone $this;
        $new->closure = $value;

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * @param string $value The error text.
     */
    public function content(string $value): self
    {
        $new = clone $this;
        $new->content = $value;

        return $new;
    }

    /**
     * Returns a new instance with the container tag name for the error.
     *
     * @param string $value The container tag name.
     */
    public function tag(string $value): self
    {
        if ($value === '') {
            throw new InvalidArgumentException('Tag name cannot be empty.');
        }

        $new = clone $this;
        $new->tag = $value;

        return $new;
    }

    public function render(): string
    {
        $closure = $this->closure;
        $content = $this->content;

        if ($content === '') {
            $content = $this->formModel->getFirstError($this->attribute);
        }

        $contentTag = Tag::create($this->tag, $content, $this->attributes);

        if ($closure instanceof Closure) {
            $contentTag = (string) $closure($this->formModel);
        }

        return match ($content !== '') {
            true => $contentTag,
            default => '',
        };
    }
}
