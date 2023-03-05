<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use InvalidArgumentException;
use Stringable;
use Yii\Widget\Attribute;
use Yii\Widget\AbstractWidget;

use function strtoupper;

abstract class AbstractForm extends AbstractWidget
{
    use Attribute\HasAttributes;
    use Attribute\HasAutocomplete;
    use Attribute\HasClass;
    use Attribute\HasId;
    use Attribute\HasName;

    protected string $action = '';
    protected array $attributes = [];
    protected string $csrfName = '';
    protected string $csrfToken = '';
    protected string $method = '';

    /**
     * Returns a new instances with the accept-charset content attribute gives the character encodings that are to be
     * used for the submission. If specified, the value must be an ordered set of unique space-separated tokens that are
     * ASCII case-insensitive, and each token must be an ASCII case-insensitive match for one of the labels of an
     * ASCII-compatible encoding.
     *
     * @param string $value The accept-charset attribute value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-accept-charset
     */
    public function acceptCharset(string $value): static
    {
        $new = clone $this;
        $new->attributes['accept-charset'] = $value;

        return $new;
    }

    /**
     * Returns a new instances with the action and form-action content attributes, if specified, must have a value that
     * is a valid non-empty URL potentially surrounded by spaces.
     *
     * @param string $value The action attribute value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-action
     */
    public function action(string $value): static
    {
        $new = clone $this;
        $new->action = $value;

        return $new;
    }

    /**
     * Returns a new instances with the CSRF-token content attribute token that are known to be safe to use for.
     *
     * @param string|Stringable $csrfToken The CSRF-token attribute value.
     * @param string $csrfName The CSRF-token attribute name.
     */
    public function csrf(string|Stringable $csrfToken, string $csrfName = '_csrf'): static
    {
        $new = clone $this;
        $new->csrfToken = (string) $csrfToken;
        $new->csrfName = $csrfName;

        return $new;
    }

    /**
     * Returns a new instances with the enctype content attribute specifies the content type of the form submission.
     *
     * @param string $value The enctype attribute value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-enctype
     */
    public function enctype(string $value): static
    {
        if (
            $value !== 'multipart/form-data' &&
            $value !== 'application/x-www-form-urlencoded' &&
            $value !== 'text/plain'
        ) {
            throw new InvalidArgumentException(
                'The formenctype attribute must be one of the following values: ' .
                '"multipart/form-data", "application/x-www-form-urlencoded", "text/plain".'
            );
        }

        $new = clone $this;
        $new->attributes['enctype'] = $value;

        return $new;
    }

    /**
     * Returns a new instances with the method attribute specifies how the form-data should be submitted.
     *
     * @param string $value The method attribute value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-method
     */
    public function method(string $value): static
    {
        $new = clone $this;
        $new->method = strtoupper($value);

        return $new;
    }

    /**
     * Returns a new instances with the novalidate attributes are boolean attributes. If present, they indicate that the
     * form is not to be validated during submission.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-novalidate
     */
    public function noValidate(): static
    {
        $new = clone $this;
        $new->attributes['novalidate'] = true;

        return $new;
    }

    /**
     * Returns a new instances with the target attributes, if specified, must have values that are valid browsing
     * context names or keywords.
     *
     * @param string $value The target attribute value.
     *
     * @link https://www.w3.org/TR/html52/sec-forms.html#element-attrdef-form-target
     */
    public function target(string $value): static
    {
        if ($value !== '_blank' && $value !== '_self' && $value !== '_parent' && $value !== '_top') {
            throw new InvalidArgumentException(
                'The formtarget attribute value must be one of "_blank", "_self", "_parent" or "_top"'
            );
        }

        $new = clone $this;
        $new->attributes['target'] = $value;

        return $new;
    }
}
