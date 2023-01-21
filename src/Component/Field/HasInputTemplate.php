<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

trait HasInputTemplate
{
    private string $inputTemplate = '{label}' . PHP_EOL . '{input}';

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
