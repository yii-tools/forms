<?php

declare(strict_types=1);

namespace Yii\Forms\Field;

/**
 * HasFieldTemplate provides the ability to set the template layout.
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
