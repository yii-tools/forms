<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait Before
{
    private string $before = '';

    /**
     * Return new instance with before field html content.
     *
     * @param string $before The html content to be added before field.
     */
    public function before(string $before): self
    {
        $new = clone $this;
        $new->before = $before;

        return $new;
    }
}
