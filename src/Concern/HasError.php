<?php

declare(strict_types=1);

namespace Yii\Forms\Concern;

use function array_flip;
use function array_intersect_key;
use function array_merge;
use function reset;

/**
 * HasError provides methods for managing errors in the model.
 */
trait HasError
{
    /**
     * @psalm-var string[][] $attributesErrors
     */
    private array $attributesErrors = [];

    /**
     * Add an error for the specified attribute.
     *
     * @param string $attribute The attribute name.
     * @param string $error The error message to be added to the attribute.
     */
    public function addError(string $attribute, string $error): void
    {
        $this->attributesErrors[$attribute][] = $error;
    }

    /**
     * Add errors for the model instance.
     *
     * @param array $values The errors to be added to the model.
     *
     * @psalm-param string[][] $values
     */
    public function addErrors(array $values): void
    {
        $this->attributesErrors = $values;
    }

    /**
     * Removes errors for all attributes or a single attribute.
     *
     * @param string|null $attribute The attribute name or null to remove errors for all attributes.
     * For default is `null`.
     */
    public function clearError(string $attribute = null): void
    {
        if ($attribute !== null) {
            unset($this->attributesErrors[$attribute]);

            return;
        }

        $this->attributesErrors = [];
    }

    /**
     * @return array The errors for all attributes.
     *
     * Note that when returning errors for all attributes, the result is a two-dimensional array, like the following:
     *
     * ```php
     * [
     *     'username' => [
     *         'Username is required.',
     *         'Username must contain only word characters.',
     *     ],
     *     'email' => [
     *         'Email address is invalid.',
     *     ]
     * ]
     * ```
     *
     * {@see getFirst()}
     * {@see getFirsts()}
     *
     * @psalm-return string[][]
     */
    public function getAllError(): array
    {
        return $this->attributesErrors;
    }

    /**
     * @param string $attribute The attribute name.
     *
     * @return array The errors for an attribute with a given name.
     *
     * @psalm-return string[]
     */
    public function getError(string $attribute): array
    {
        return $this->attributesErrors[$attribute] ?? [];
    }

    /**
     * @param string $attribute The attribute name.
     *
     * @return string The error message. Empty string is returned if there is no error.
     *
     * {@see get()}
     * {@see getFirsts()}
     */
    public function getFirstError(string $attribute): string
    {
        return match (empty($this->attributesErrors[$attribute])) {
            true => '',
            false => reset($this->attributesErrors[$attribute]),
        };
    }

    /**
     * @return array The first errors. The array keys are the attribute names, and the array values are the
     * corresponding error messages. An empty array will be returned if there is no error.
     *
     * {@see get()}
     * {@see getFirst()}
     *
     * @psalm-return string[]
     */
    public function getFirstsError(): array
    {
        if ($this->attributesErrors === []) {
            return [];
        }

        $errors = [];

        foreach ($this->attributesErrors as $name => $es) {
            if (!empty($es)) {
                $errors[$name] = reset($es);
            }
        }

        return $errors;
    }

    /**
     * @param array $onlyAttributes List of attributes to return errors.
     *
     * @return array The errors for all attributes as a one-dimensional array. Empty array is returned if no error.
     *
     * {@see get()}
     * {@see getFirsts(){}
     */
    public function getSummaryError(array $onlyAttributes = []): array
    {
        $errors = $this->attributesErrors;

        if ($onlyAttributes !== []) {
            $errors = array_intersect_key($errors, array_flip($onlyAttributes));
        }

        return $this->renderErrorSummary($errors);
    }

    /**
     * @return array The first error of every attribute in the collection. Empty array is returned if no error.
     */
    public function getSummaryFirstError(): array
    {
        return $this->renderErrorSummary([$this->getFirstsError()]);
    }

    /**
     * Returns a value indicating whether there is any validation error.
     *
     * @param string|null $attribute The attribute name. Use null to check all attributes.
     *
     * @return bool Whether there is any error.
     */
    public function hasError(string $attribute = null): bool
    {
        if ($attribute === null) {
            return false;
        }

        return isset($this->attributesErrors[$attribute]);
    }

    /**
     * @psalm-param string[][] $errors The errors to render.
     *
     * @return string[] The rendered errors.
     */
    private function renderErrorSummary(array $errors): array
    {
        $lines = [];

        foreach ($errors as $error) {
            $lines = array_merge($lines, $error);
        }

        return $lines;
    }
}
