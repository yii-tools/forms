<?php

declare(strict_types=1);

namespace Yii\Forms;

use InvalidArgumentException;

use function array_key_exists;
use function is_string;

/**
 * The textarea element represents a multi-line plain-text edit control for the element’s raw value.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/textarea.html
 */
final class TextArea extends Base\AbstractTextArea
{
    protected function run(): string
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
            throw new InvalidArgumentException('TextArea::class widget must be a string or null value.');
        }

        $placeHolder = $this->getPlaceholder();

        if (!array_key_exists('placeholder', $attributes) && '' !== $placeHolder) {
            $attributes['placeholder'] = $placeHolder;
        }

        return $this->renderInput('textarea', (string) $content, null, $attributes);
    }
}
