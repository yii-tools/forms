<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

/**
 * HasTemplate provides the ability to set the template field layout.
 */
trait HasTemplate
{
    private string $template = "{prefix}\n{field}\n{suffix}\n{hint}\n{error}";

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
