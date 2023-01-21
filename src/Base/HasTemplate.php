<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

/**
 * HasTemplate trait provides methods to set input template for the field.
 */
trait HasTemplate
{
    private string $template = '{prefix}{input}{suffix}';

    /**
     * Return new instance with input template.
     *
     * @param string $value The input template.
     */
    public function template(string $value): static
    {
        $new = clone $this;
        $new->template = $value;

        return $new;
    }
}
