<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait After
{
    private string $after = '';

    /**
     * Return new instance with after field html content.
     *
     * @param string $after The html content to be added after the field.
     */
    public function after(string $after): self
    {
        $new = clone $this;
        $new->after = $after;

        return $new;
    }
}
