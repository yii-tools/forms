<?php

declare(strict_types=1);

namespace Yii\Forms\Concern;

use InvalidArgumentException;

use function array_key_exists;
use function method_exists;

/**
 * HasHint provides methods for getting the hint for the specified attribute of the model.
 */
trait HasHint
{
    /**
     * @param string $attribute The attribute name.
     *
     * @return string The text hint for the specified attribute.
     */
    public function getHint(string $attribute): string
    {
        $nestedHint = $this->getNestedValue('getHint', $attribute);

        return match ($this->has($attribute)) {
            true => $nestedHint === '' ? $this->getInternalHint($attribute) : $nestedHint,
            false => throw new InvalidArgumentException("Attribute '$attribute' does not exist."),
        };
    }

    /**
     * Returns the hint for the specified attribute.
     *
     * @param string $attribute The attribute name.
     */
    private function getInternalHint(string $attribute): string
    {
        $hint = '';
        $hints = [];

        if (method_exists($this, 'getHints')) {
            $hints = $this->getHints();
        }

        if (array_key_exists($attribute, $hints)) {
            $hint = $hints[$attribute];
        }

        return $hint;
    }
}
