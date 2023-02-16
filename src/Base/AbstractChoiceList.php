<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use InvalidArgumentException;
use Yii\Forms\Label;
use Yii\Html\Helper\Utils;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

abstract class AbstractChoiceList extends AbstractInputWidget
{
    use Attribute\CanBeChecked;
    use Attribute\HasContainer;
    use Attribute\HasItems;
    use Attribute\HasLabel;

    protected string $containerTag = 'div';
    protected array $individualItemsAttributes = [];
    protected string $separator = PHP_EOL;

    /**
     * Return new instance specifying the items of the checkbox list, when the widget is used in boolean mode.
     */
    public function boolean(): static
    {
        $new = clone $this;
        $new->items = ['0' => 'No', '1' => 'Yes'];

        return $new;
    }

    /**
     * Return new instance specified the tag name for the container element.
     *
     * @param string $value The tag name for the container element.
     */
    public function containerTag(string $value): static
    {
        if ($value === '') {
            throw new InvalidArgumentException('The container tag must be a non-empty string.');
        }

        $new = clone $this;
        $new->containerTag = $value;

        return $new;
    }

    /**
     * Return new instance specified individual items attributes HTML for choice widget.
     *
     * @param array $values The attributes HTML for individual items.
     */
    public function individualItemsAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->individualItemsAttributes = $values;

        return $new;
    }

    /**
     * Return new instance specified the separator between the generated checkbox list items.
     *
     * @param string $value The separator between the generated checkbox list items.
     */
    public function separator(string $value): static
    {
        $new = clone $this;
        $new->separator = $value;

        return $new;
    }

    protected function buildAttributes(array $attributes, array $containerAttributes): array
    {
        $attributes = array_merge($attributes, $this->itemsAttributes);

        if (array_key_exists('autofocus', $attributes)) {
            $containerAttributes['autofocus'] = is_bool($attributes['autofocus']);
            unset($attributes['autofocus']);
        }

        if (array_key_exists('id', $attributes)) {
            $containerAttributes['id'] = is_string($attributes['id']) ? $attributes['id'] : null;
            unset($attributes['id']);
        }

        if (!array_key_exists('id', $containerAttributes)) {
            $containerAttributes['id'] = $this->getId();
        }

        if (array_key_exists('tabindex', $attributes)) {
            $containerAttributes['tabindex'] = is_numeric($attributes['tabindex']) ? $attributes['tabindex'] : null;
            unset($attributes['tabindex']);
        }

        $name = match (array_key_exists('name', $attributes)) {
            true => is_string($attributes['name']) ? $attributes['name'] : '',
            default => Utils::generateInputName($this->formModel->getFormName(), $this->attribute),
        };

        $attributes['id'] = null;
        $attributes['name'] = Utils::generateArrayableName($name);

        return [$attributes, $containerAttributes];
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    protected function renderChoiceTag(
        string $type,
        array $attributes,
        string $label,
        string|bool|int|float|null $valueDefault,
        array $values
    ): string {
        $attributes['checked'] = in_array($valueDefault, $values);

        /** @psalm-var mixed */
        $attributes['value'] = $valueDefault;

        $checkboxTag = $this->run('input', '', $type, $attributes);

        return Label::widget([$this->formModel, $this->attribute])
            ->content($checkboxTag . $label)
            ->encode(false)
            ->for()
            ->render();
    }
}
