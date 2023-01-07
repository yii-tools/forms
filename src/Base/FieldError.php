<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Helper\CssClass;

trait FieldError
{
    private array $errorAttributes = [];
    private string $errorClass = '';
    private array $errorCallback = [];
    private string $errorMessage = '';
    private string $errorTag = 'div';

    /**
     * Returns a new instance with the error attributes.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function errorAttributes(array $values): self
    {
        $new = clone $this;
        $new->errorAttributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with the error callback.
     *
     * @param array $value The error callback.
     */
    public function errorCallback(array $value): self
    {
        $new = clone $this;
        $new->errorCallback = $value;

        return $new;
    }

    /**
     * Returns a new instance with the error class.
     *
     * @param string $value The error class.
     *
     * @return self
     */
    public function errorClass(string $value): self
    {
        $new = clone $this;
        CssClass::add($new->errorAttributes, $value);

        return $new;
    }

    /**
     * Returns a new instance with the error text.
     *
     * @param string $value The error message.
     */
    public function errorMessage(string $value): self
    {
        $new = clone $this;
        $new->errorMessage = $value;

        return $new;
    }

    /**
     * Returns a new instance with the error tag.
     *
     * @param string $value The error tag.
     */
    public function errorTag(string $value): self
    {
        $new = clone $this;
        $new->errorTag = $value;

        return $new;
    }
}
