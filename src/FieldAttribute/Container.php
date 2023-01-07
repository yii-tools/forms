<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait Container
{
    private bool $container = true;

    /**
     * Return new instance with container enabled or disabled for the field.
     *
     * @param bool $value True to enable container, false to disable.
     */
    public function container(bool $value): static
    {
        $new = clone $this;
        $new->container = $value;

        return $new;
    }
}
