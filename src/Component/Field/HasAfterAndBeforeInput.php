<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

use Stringable;

/**
 * HasAfterAndBeforeInput trait provides methods to add html content before and after the input in a field.
 */
trait HasAfterAndBeforeInput
{
    private string $afterInput = '';
    private string $beforeInput = '';

    /**
     * Return new instance with after input html content.
     *
     * @param string|Stringable $value The html content to be added after the input.
     */
    public function afterInput(string|Stringable $value): static
    {
        $new = clone $this;
        $new->afterInput = (string) $value;

        return $new;
    }

    /**
     * Return new instance with before input html content.
     *
     * @param string|Stringable $value The html content to be added before the input.
     */
    public function beforeInput(string|Stringable $value): static
    {
        $new = clone $this;
        $new->beforeInput = (string) $value;

        return $new;
    }
}
