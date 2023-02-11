<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;

use function array_merge;
use function get_debug_type;
use function implode;
use function in_array;

abstract class AbstractSelect extends AbstractInputWidget
{
    use Attribute\CanBeMultiple;
    use Attribute\HasForm;
    use Attribute\HasGroup;
    use Attribute\HasItems;
    use Attribute\HasPrompt;
    use Attribute\HasSize;

    /**
     * @psalm-return string[]
     */
    protected function renderItems(mixed $formValue): array
    {
        $formValue = match (get_debug_type($formValue)) {
            'array' => $formValue,
            default => [$formValue],
        };
        $items = [];
        $itemsAttributes = $this->itemsAttributes;
        /** @psalm-var string[]|string[][] $values */
        $values = $this->items;

        foreach ($values as $value => $content) {
            if (is_array($content)) {
                /** @psalm-var array $groupAttrs */
                $groupAttrs = $this->groups[$value] ?? [];
                $options = [];

                foreach ($content as $v => $c) {
                    /** @psalm-var array */
                    $itemsAttributes[$v] ??= [];
                    $options[] = Tag::create(
                        'option',
                        $c,
                        array_merge(
                            $itemsAttributes[$v],
                            ['selected' => in_array($v, $formValue), 'value' => $v],
                        )
                    );
                }

                $items[] = Tag::create('optgroup', implode(PHP_EOL, $options), $groupAttrs);
            } else {
                /** @psalm-var array */
                $itemsAttributes[$value] ??= [];
                $items[] = Tag::create(
                    'option',
                    $content,
                    array_merge(
                        $itemsAttributes[$value],
                        ['selected' => in_array($value, $formValue), 'value' => $value],
                    )
                );
            }
        }

        return $items;
    }
}
