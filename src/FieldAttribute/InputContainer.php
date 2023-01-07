<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait InputContainer
{
    private bool $inputContainer = false;

    /**
     * Return new instance with input container enabled or disabled for the field.
     *
     * @param bool $value True to enable input container, false to disable.
     */
    public function inputContainer(bool $value): static
    {
        $new = clone $this;
        $new->inputContainer = $value;

        return $new;
    }
}
