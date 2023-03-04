<?php

declare(strict_types=1);

namespace Yii\Forms\Field\Concern;

/**
 * Provides the ability to set the template layout for the field.
 */
trait HasFieldTemplate
{
    private string $template = "{prefix}\n{field}\n{suffix}\n{hint}\n{error}";

    /**
     * Return new instance with the template layout.
     *
     * @param string $value The template layout.
     */
    public function template(string $value): static
    {
        $new = clone $this;
        $new->template = $value;

        return $new;
    }
}
