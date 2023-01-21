<?php

declare(strict_types=1);

namespace Yii\Forms\Concern;

use InvalidArgumentException;

use function array_key_exists;
use function method_exists;

/**
 * The HasPlaceholder trait provides methods for working with placeholders for attributes of a form model.
 */
trait HasPlaceholder
{
    /**
     * @param string $attribute The attribute name.
     *
     * @return string The text placeholder for the specified attribute.
     */
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
     *
     * @param string $attribute The attribute name.
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
