<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait ValidClass
{
    private string $validClass = '';

    /**
     * Return new instance with valid css class to add to the field.
     *
     * @param string $value The css class to add to the input element.
     */
    public function validClass(string $value): self
    {
        $new = clone $this;
        $new->validClass = $value;

        return $new;
    }
}
