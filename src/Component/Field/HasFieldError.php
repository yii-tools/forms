<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

use Closure;
use Yii\Html\Helper\CssClass;

/**
 * HasFieldError provides methods to set error attributes for the field.
 */
trait HasFieldError
{
    private array $errorAttributes = [];
    private string $errorClass = '';
    private Closure|null $errorClosure = null;
    private string $errorContent = '';
    private string $errorTag = 'div';
    private bool $showAllErrors = false;

    /**
     * Returns a new instance with the error attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function errorAttributes(array $values): static
    {
        $new = clone $this;
        $new->errorAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the error class.
     *
     * @param string $value The error class.
     */
    public function errorClass(string $value): static
    {
        $new = clone $this;
        CssClass::add($new->errorAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the error closure.
     *
     * @param Closure $value The error closure.
     */
    public function errorClosure(Closure $value): static
    {
        $new = clone $this;
        $new->errorClosure = $value;

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * @param string $value The error message.
     */
    public function errorContent(string $value): static
    {
        $new = clone $this;
        $new->errorContent = $value;

        return $new;
    }

    /**
     * Returns a new instance with the error tag.
     *
     * @param string $value The error tag.
     */
    public function errorTag(string $value): static
    {
        $new = clone $this;
        $new->errorTag = $value;

        return $new;
    }

    /**
     * Returns a new instance with the show all errors flag.
     */
    public function showAllErrors(): static
    {
        $new = clone $this;
        $new->showAllErrors = true;

        return $new;
    }
}
