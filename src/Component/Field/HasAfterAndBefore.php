<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

use Stringable;

/**
 * HasAfterAndBefore trait provides methods to set after and before field html content in a field.
 */
trait HasAfterAndBefore
{
    private string $after = '';
    private string $before = '';

    /**
     * Return new instance with after field html content.
     *
     * @param string|Stringable $after The html content to be added after the field.
     */
    public function after(string|Stringable $after): static
    {
        $new = clone $this;
        $new->after = (string) $after;

        return $new;
    }

    /**
     * Return new instance with before field html content.
     *
     * @param string|Stringable $before The html content to be added before field.
     */
    public function before(string|Stringable $before): static
    {
        $new = clone $this;
        $new->before = (string) $before;

        return $new;
    }
}
