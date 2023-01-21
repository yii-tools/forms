<?php

declare(strict_types=1);

namespace Yii\Forms\Concern;

use InvalidArgumentException;
use Yiisoft\Strings\Inflector;
use Yiisoft\Strings\StringHelper;

use function array_key_exists;
use function method_exists;

/**
 * HasLabel provides methods for getting attribute labels of the form model, which are used in error messages and other
 * messages displayed to end users in the view.
 */
trait HasLabel
{
    /**
     * Returns the label for the specified attribute. If the attribute does not have a label, a label is generated using
     * {@see generateLabel()}.
     */
    public function getLabel(string $attribute): string
    {
        $nestedLabel = $this->getNestedValue('getLabel', $attribute);

        return match ($this->has($attribute)) {
            true => $nestedLabel === '' ? $this->getInternalLabel($attribute) : $nestedLabel,
            false => throw new InvalidArgumentException("Attribute '$attribute' does not exist."),
        };
    }

    /**
     * Generates a user-friendly attribute label based on the give attribute name.
     *
     * This is done by replacing underscores, dashes and dots with blanks and changing the first letter of each word to
     * upper case.
     *
     * For example, 'department_name' or 'DepartmentName' will generate 'Department Name'.
     *
     * @param string $name The column name.
     *
     * @return string The attribute label.
     */
    private function generateLabel(string $name): string
    {
        $inflector = new Inflector();

        return StringHelper::uppercaseFirstCharacterInEachWord($inflector->toWords($name));
    }

    /**
     * Returns the label for the specified attribute. If the attribute does not have a label, a label is generated using
     * {@see generateLabel()}.
     */
    private function getInternalLabel(string $attribute): string
    {
        $label = $this->generateLabel($attribute);
        $labels = method_exists($this, 'getLabels') ? $this->getLabels() : [];

        if (array_key_exists($attribute, $labels)) {
            $label = $labels[$attribute];
        }

        return $label;
    }
}
