<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Stringable;

/**
 * HasPrefixAndSuffix provides methods to set prefix and suffix field for before and after field html content.
 */
trait HasPrefixAndSuffix
{
    private string $prefix = '';
    private string $suffix = '';

    /**
     * Return new instance with before field html content.
     *
     * @param string|Stringable $value The html content to be added before the field.
     */
    public function prefix(string|Stringable $value): static
    {
        $new = clone $this;
        $new->prefix = (string) $value;

        return $new;
    }

    /**
     * Return new instance with after field html content.
     *
     * @param string|Stringable $value The html content to be added after the field.
     */
    public function suffix(string|Stringable $value): static
    {
        $new = clone $this;
        $new->suffix = (string) $value;

        return $new;
    }
}
