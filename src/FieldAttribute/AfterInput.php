<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

use Stringable;

trait AfterInput
{
    private string $afterInput = '';

    /**
     * Return new instance with after input html content.
     *
     * @param string $after The html content to be added after the input.
     */
    public function afterInput(string|Stringable $value): self
    {
        $new = clone $this;
        $new->afterInput = (string) $value;

        return $new;
    }
}
