<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Base;

use Yii\Html\Tag;
use Yii\Widget\Attribute;
use Yii\Widget\Input\AbstractInputWidget;

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
        /** @psalm-var string[]|string[][] */
        $values = $this->items;

        foreach ($values as $value => $content) {
            if (is_array($content)) {
                /** @var array */
                $groupAttrs = $this->groups[$value] ?? [];
                $options = [];

                foreach ($content as $v => $c) {
                    /** @var array */
                    $itemsAttributes[$v] ??= [];
                    $options[] = Tag::create(
                        'option',
                        $c,
                        array_merge(
                            $itemsAttributes[$v],
                            ['selected' => in_array($v, $formValue) ? true : false, 'value' => $v],
                        )
                    );
                }

                $items[] = Tag::create('optgroup', implode(PHP_EOL, $options), $groupAttrs);
            } else {
                /** @var array */
                $itemsAttributes[$value] ??= [];
                $items[] = Tag::create(
                    'option',
                    $content,
                    array_merge(
                        $itemsAttributes[$value],
                        ['selected' => in_array($value, $formValue) ? true : false, 'value' => $value],
                    )
                );
            }
        }

        return $items;
    }
}
