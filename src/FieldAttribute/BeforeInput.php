<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

use Stringable;

trait BeforeInput
{
    private string $beforeInput = '';

    /**
     * Return new instance with before input html content.
     *
     * @param string $before The html content to be added before the input.
     */
    public function beforeInput(string|Stringable $value): self
    {
        $new = clone $this;
        $new->beforeInput = (string) $value;

        return $new;
    }
}
