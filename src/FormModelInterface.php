<?php

declare(strict_types=1);

namespace Yii\Forms;

/**
 * The FormModelInterface class defines a set of methods that must be implemented by classes that represent a form
 * model.
 *
 * A form model is a class that represents a form in a web application and is used to validate user input and handle
 * form submissions. It is usually used in conjunction with a view template that renders the form, and a controller that
 * processes the form submission and performs any necessary business logic.
 */
interface FormModelInterface
{
    /**
     * @param string $attribute
     *
     * @return mixed The value (raw data) for the specified attribute.
     */
    public function getAttributeValue(string $attribute): mixed;

    /**
     * @param string $attribute The attribute name.
     *
     * @return string The error message. Empty string is returned if there is no error.
     */
    public function getFirstError(string $attribute): string;

    /**
     * Returns the form name that this model class should use.
     *
     * The form name is mainly used by {@see Model} to determine how to name the input fields for the attributes in a
     * model.
     *
     * If the form name is "A" and an attribute name is "b", then the corresponding input name would be "A[b]".
     * If the form name is an empty string, then the input name would be "b".
     *
     * The purpose of the above naming schema is that for forms which contain multiple different models, the attributes
     * of each model are grouped in sub-arrays of the POST-data, and it is easier to differentiate between them.
     *
     * By default, this method returns the model class name (without the namespace part) as the form name. You may
     * override it when the model is used in different forms.
     *
     * @return string The form name class, without a namespace part or empty string when class is anonymous.
     *
     * {@see load()}
     */
    public function getFormName(): string;

    /**
     * @param string $attribute The attribute name.
     *
     * @return string The text hint for the specified attribute.
     */
    public function getHint(string $attribute): string;

    /**
     * @param string $attribute The attribute name.
     *
     * @return string the text label for the specified attribute.
     */
    public function getLabel(string $attribute): string;

    /**
     * @param string $attribute The attribute name.
     *
     * @return string The text placeholder for the specified attribute.
     */
    public function getPlaceholder(string $attribute): string;

    /**
     * If there is such attribute in the set.
     *
     * @param string $attribute
     *
     * @return bool
     */
    public function has(string $attribute): bool;

    /**
     * Returns a value indicating whether there is any validation error.
     *
     * @param string|null $attribute The attribute name. Use null to check all attributes.
     *
     * @return bool Whether there is any error.
     */
    public function hasError(string $attribute = null): bool;

    /**
     * Whether the form model is empty.
     */
    public function isEmpty(): bool;
}
