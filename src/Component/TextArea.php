<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use InvalidArgumentException;
use Yii\Widget\Input\AbstractInputWidget;
use Yii\Widget\Attribute;

use function array_key_exists;
use function is_string;

/**
 * The textarea element represents a multi-line plain-text edit control for the element’s raw value.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html
 */
final class TextArea extends AbstractInputWidget
{
    use Attribute\HasAutocomplete;
    use Attribute\HasCols;
    use Attribute\HasDirname;
    use Attribute\HasMaxLength;
    use Attribute\HasMinLength;
    use Attribute\HasPlaceholder;
    use Attribute\HasRows;
    use Attribute\HasWrap;

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

    public function render(): string
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

        $placeHolder = $this->getPlaceholder();

        if (!array_key_exists('placeholder', $attributes) && '' !== $placeHolder) {
            $attributes['placeholder'] = $placeHolder;
        }

        return $this->run('textarea', (string) $content, null, $attributes);
    }
}
