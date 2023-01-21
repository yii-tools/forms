<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

trait HasValidateClass
{
    private string $invalidClass = '';
    private string $validClass = '';

    /**
     * Return new instance with invalid css class to add to the field.
     *
     * @param string $value The css class to add to the input element.
     */
    public function invalidClass(string $value): static
    {
        $new = clone $this;
        $new->invalidClass = $value;

        return $new;
    }

    /**
     * Return new instance with valid css class to add to the field.
     *
     * @param string $value The css class to add to the input element.
     */
    public function validClass(string $value): static
    {
        $new = clone $this;
        $new->validClass = $value;

        return $new;
    }
}
