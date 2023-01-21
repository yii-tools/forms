<?php

declare(strict_types=1);

namespace Yii\Forms\Concern;

use InvalidArgumentException;

use function array_key_exists;
use function method_exists;

trait HasPlaceholder
{
    public function getPlaceholder(string $attribute): string
    {
        $nestedPlaceholder = $this->getNestedValue('getPlaceholder', $attribute);

        return match ($this->has($attribute)) {
            true => $nestedPlaceholder === '' ? $this->getInternalPlaceholder($attribute) : $nestedPlaceholder,
            false => throw new InvalidArgumentException("Attribute '$attribute' does not exist."),
        };
    }

    /**
     * Returns the placeholder for the specified attribute.
     */
    private function getInternalPlaceholder(string $attribute): string
    {
        $placeholder = '';
        $placeholders = method_exists($this, 'getPlaceholders') ? $this->getPlaceholders() : [];

        if (array_key_exists($attribute, $placeholders)) {
            $placeholder = $placeholders[$attribute];
        }

        return $placeholder;
    }
}
