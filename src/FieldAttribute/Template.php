<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait Template
{
    private string $template = '{field}' . PHP_EOL . '{hint}' . PHP_EOL . '{error}';

    /**
     * Return new instance with the template field layout.
     *
     * @param string $value The template field.
     */
    public function template(string $value): static
    {
        $new = clone $this;
        $new->template = $value;

        return $new;
    }
}
