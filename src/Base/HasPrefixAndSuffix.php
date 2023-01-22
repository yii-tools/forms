<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Stringable;

/**
 * HasPrefixAndSuffix provides methods to set prefix and suffix.
 */
trait HasPrefixAndSuffix
{
    private string $prefix = '';
    private string $suffix = '';

    /**
     * Return new instance with before html content.
     *
     * @param string|Stringable $value The html content to be added before.
     */
    public function prefix(string|Stringable $value): static
    {
        $new = clone $this;
        $new->prefix = (string) $value;

        return $new;
    }

    /**
     * Return new instance with after html content.
     *
     * @param string|Stringable $value The html content to be added after.
     */
    public function suffix(string|Stringable $value): static
    {
        $new = clone $this;
        $new->suffix = (string) $value;

        return $new;
    }
}
