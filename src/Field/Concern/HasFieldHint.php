<?php

declare(strict_types=1);

namespace Yii\Forms\Field\Concern;

use Closure;
use Yii\Html\Helper\CssClass;

/**
 * Provides methods for configuring field hint.
 */
trait HasFieldHint
{
    private array $hintAttributes = [];
    private string $hintClass = '';
    private Closure|null $hintClosure = null;
    private bool $hintContainer = true;
    private array $hintContainerAttributes = [];
    private string $hintContent = '';
    private string $hintTag = 'div';

    /**
     * Returns a new instance with the hint attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function hintAttributes(array $values): static
    {
        $new = clone $this;
        $new->hintAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the hint css class.
     *
     * @param string $value The hint class.
     */
    public function hintClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->hintAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the hint closure.
     *
     * @param Closure $value The hint closure.
     */
    public function hintClosure(Closure $value): static
    {
        $new = clone $this;
        $new->hintClosure = $value;

        return $new;
    }

    /**
     * Returns a new instance with the hint text.
     *
     * @param string $value The hint content. If null, the hint will be removed.
     */
    public function hintContent(string $value): static
    {
        $new = clone $this;
        $new->hintContent = $value;

        return $new;
    }

    /**
     * Returns a new instance with the hint tag name.
     *
     * @param string $value The hint tag name.
     */
    public function hintTag(string $value): static
    {
        $new = clone $this;
        $new->hintTag = $value;

        return $new;
    }
}
