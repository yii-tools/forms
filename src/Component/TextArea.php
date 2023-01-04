<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use InvalidArgumentException;
use Stringable;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Forms\Base\Globals;
use Yii\Html\Attribute;
use Yii\Html\Tag;

use function array_key_exists;
use function in_array;
use function is_string;

/**
 * The textarea element represents a multi-line plain-text edit control for the element’s raw value.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html
 */
final class TextArea extends AbstractFormWidget
{
    use Attribute\AriaLabel;
    use Attribute\Autocomplete;
    use Attribute\Dirname;
    use Attribute\Disabled;
    use Attribute\Form;
    use Attribute\MaxLength;
    use Attribute\MinLength;
    use Attribute\Placeholder;
    use Attribute\Readonlys;
    use Attribute\Required;
    use Globals;

    /**
     * Returns a new instance specifying maximum number of characters per line of text for the UA to show.
     *
     * @param int $value The maximum number of characters per line of text for the UA to show.
     *
     * @link https://html.spec.whatwg.org/multipage/form-elements.html#attr-textarea-cols
     */
    public function cols(int $value): self
    {
        $new = clone $this;
        $new->attributes['cols'] = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the initial contents of the control.
     *
     * @param string $value The initial contents of the control.
     */
    public function content(string $value): self
    {
        $new = clone $this;
        $new->attributes['value'] = $value;

        return $new;
    }

    public function render(): string|Stringable
    {
        $attributes = $this->attributes;
        $content = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue(),
        };

        unset($attributes['value']);

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/syntax.html#contents
         */
        if (!is_string($content) && null !== $content) {
            throw new InvalidArgumentException('TextArea widget must be a string or null value.');
        }

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = $this->getInputId();
        }

        if (!array_key_exists('name', $attributes)) {
            $attributes['name'] = $this->getInputName();
        }

        $placeHolder = $this->getPlaceHolder();

        if (!array_key_exists('placeholder', $attributes) && '' !== $placeHolder) {
            $attributes['placeholder'] = $placeHolder;
        }

        return Tag::create('textarea', (string) $content, $attributes);
    }

    /**
     * The number of lines of text for the UA to show.
     *
     * @param int $value
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.rows
     */
    public function rows(int $value): self
    {
        $new = clone $this;
        $new->attributes['rows'] = $value;

        return $new;
    }

    /**
     * The wrap attribute is an enumerated attribute with two keywords and states: the soft keyword which maps to the
     * Soft state, and the hard keyword which maps to the Hard state. The missing value default and invalid value
     * default are the Soft state.
     *
     * @param string $value Contains the hard and soft values.
     * `hard` Instructs the UA to insert line breaks into the submitted value of the textarea such that each line has no
     *  more characters than the value specified by the cols attribute.
     * `soft` Instructs the UA to add no line breaks to the submitted value of the textarea.
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.wrap.hard
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html#textarea.attrs.wrap.soft
     */
    public function wrap(string $value = 'hard'): self
    {
        if (!in_array($value, ['hard', 'soft'])) {
            throw new InvalidArgumentException('Invalid wrap value. Valid values are: hard, soft.');
        }

        $new = clone $this;
        $new->attributes['wrap'] = $value;

        return $new;
    }
}
