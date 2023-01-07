<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait InvalidClass
{
    private string $invalidClass = '';

    /**
     * Return new instance with invalid css class to add to the field.
     *
     * @param string $value The css class to add to the input element.
     */
    public function invalidClass(string $value): self
    {
        $new = clone $this;
        $new->invalidClass = $value;

        return $new;
    }
}
