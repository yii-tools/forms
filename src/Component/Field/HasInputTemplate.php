<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

/**
 * HasInputTemplate provides methods to set input template for the field.
 */
trait HasInputTemplate
{
    private string $inputTemplate = "{label}\n{input}" ;

    /**
     * Return new instance with input template.
     *
     * @param string $value The input template.
     */
    public function inputTemplate(string $value): static
    {
        $new = clone $this;
        $new->inputTemplate = $value;

        return $new;
    }
}
