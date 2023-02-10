<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use InvalidArgumentException;
use Stringable;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;

use function array_key_exists;
use function implode;
use function is_object;

/**
 * The select element represents a control for selecting among a list of options.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/select.html
 */
final class Select extends Base\AbstractSelect
{
    public function render(): string
    {
        $attributes = $this->attributes;

        /**
         * @psalm-var iterable<int, Stringable|scalar>|scalar|null $value
         *
         * @link https://www.w3.org/TR/2011/WD-html5-20110525/association-of-controls-and-forms.html#concept-fe-value
         */
        $value = match (array_key_exists('value', $attributes)) {
            true => $attributes['value'],
            false => $this->getValue() === '' ? null : $this->getValue(),
        };

        unset($attributes['value']);

        if (is_object($value)) {
            throw new InvalidArgumentException(
                Utils::shortNameClass(self::class) . ' widget value can not be an object.'
            );
        }

        $items = match ($this->prompt) {
            '' => PHP_EOL . Tag::create('option', 'Select an option'),
            default => PHP_EOL . $this->prompt,
        };

        if ($this->items !== []) {
            $items .= PHP_EOL . implode(PHP_EOL, $this->renderItems($value)) . PHP_EOL;
        }

        return $this->run('select', $items, null, $attributes);
    }
}
