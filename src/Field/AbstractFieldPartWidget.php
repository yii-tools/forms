<?php

declare(strict_types=1);

namespace Yii\Forms\Field;

use Closure;
use InvalidArgumentException;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Widget\AbstractWidget;
use Yii\Widget\Attribute\HasAttributes;

/**
 * The base class for widgets that are used to generate the parts of the field `label`, `error` and `hint`.
 */
abstract class AbstractFieldPartWidget extends AbstractWidget
{
    use HasAttributes;

    protected Closure|null $closure = null;
    protected string $content = '';
    protected string $tag = 'div';

    public function __construct(
        protected readonly FormModelInterface $formModel,
        protected readonly string $attribute = ''
    ) {
        if ($this->formModel->has($this->attribute) === false) {
            throw new AttributeNotSet();
        }
    }

    /**
     * Returns a new instance with closure that will be called to obtain content.
     *
     * @param Closure $value The closure that will be called to obtain content.
     */
    public function closure(Closure $value): static
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
    public function content(string $value): static
    {
        $new = clone $this;
        $new->content = $value;

        return $new;
    }

    /**
     * Returns a new instance with the container tag name.
     *
     * @param string $value The container tag name.
     */
    public function tag(string $value): static
    {
        if ($value === '') {
            throw new InvalidArgumentException('Tag name cannot be empty.');
        }

        $new = clone $this;
        $new->tag = $value;

        return $new;
    }
}
