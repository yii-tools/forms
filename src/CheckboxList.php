<?php

declare(strict_types=1);

namespace Yii\Forms;

use InvalidArgumentException;
use Stringable;
use Yii\Html\Helper\Encode;
use Yii\Html\Tag;

/*
 * Generates a list of checkboxes.
 *
 * A checkbox list allows multiple selection.
 */
final class CheckboxList extends Base\AbstractChoiceList
{
    public function render(): string
    {
        /**
         * @psalm-var array[] $attributes
         * @psalm-var array[] $containerAttributes
         */
        [$attributes, $containerAttributes] = $this->buildAttributes($this->attributes, $this->containerAttributes);

        /** @psalm-var bool[]|float[]|int[]|string[]|Stringable[] $items */
        $items = $this->items;

        if ($items === []) {
            return '';
        }

        /**
         * @var mixed $values
         *
         * @link https://html.spec.whatwg.org/multipage/input.html#attr-input-value
         */
        $values = $attributes['value'] ?? $this->getValue();

        unset($attributes['value']);

        if (!is_array($values) && $values !== null) {
            throw new InvalidArgumentException('CheckboxList::class widget must be a array or null value.');
        }

        $checkboxItems = [];

        foreach ($items as $valueDefault => $label) {
            /** @psalm-var array $individualItemsAttributes */
            $individualItemsAttributes = $this->individualItemsAttributes[$valueDefault] ?? [];

            $checkboxItems[] = $this->renderChoiceTag(
                'checkbox',
                array_merge($attributes, $individualItemsAttributes),
                Encode::content($label),
                $valueDefault,
                $values ?? [],
            );
        }

        return match ($this->container) {
            true => Tag::create($this->containerTag, implode($this->separator, $checkboxItems), $containerAttributes),
            default => implode($this->separator, $checkboxItems),
        };
    }
}
