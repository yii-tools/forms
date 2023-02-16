<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Exception;
use Yii\Forms\Input\Button;
use Yii\Widget\Attribute\HasContainer;
use Yiisoft\Widget\Widget;

use function array_merge;
use function implode;
use function is_array;

abstract class AbstractButtonGroup extends Widget
{
    use HasContainer;

    protected array $buttons = [];
    /** @psalm-var array[] */
    protected array $individualButtonAttributes = [];

    /**
     * Returns a new instance specifying List of buttons. Each array element represents a single button which can be
     * specified as a string or an array of  the following structure:
     *
     * - label: string, required, the button label.
     * - attributes: array, optional, the HTML attributes of the button.
     * - type: string, optional, the button type.
     * - visible: bool, optional, whether this button is visible. Defaults to true.
     *
     * @param array $values The buttons' configuration.
     */
    public function buttons(array $values): static
    {
        $new = clone $this;
        $new->buttons = $values;

        return $new;
    }

    /**
     * Returns a new instance specifying attributes for button.
     *
     * @param array $values The button attributes.
     *
     * @psalm-param array[] $values
     */
    public function individualButtonAttributes(array $values = []): static
    {
        $new = clone $this;
        $new->individualButtonAttributes = $values;

        return $new;
    }

    /**
     * Generates the buttons that compound the group as specified on {@see buttons}.
     *
     * @throws Exception
     *
     * @return string the rendering result.
     */
    protected function renderButtons(): string
    {
        $htmlButtons = [];

        /** @psalm-var array<string, array|string> $buttons */
        $buttons = $this->buttons;

        foreach ($buttons as $key => $button) {
            $type = 'button';
            $value = null;

            if (is_array($button)) {
                /** @psalm-var array $attributes */
                $attributes = $button['attributes'] ?? [];

                $visible = match (array_key_exists('visible', $button) && is_bool($button['visible'])) {
                    true => $button['visible'],
                    default => true,
                };

                if ($visible) {
                    // Set individual button attributes.
                    $individualButtonAttributes = $this->individualButtonAttributes[$key] ?? [];
                    $attributes = array_merge($attributes, $individualButtonAttributes);
                    if (array_key_exists('value', $button) && is_string($button['value'])) {
                        $value = $button['value'];
                    }

                    if (array_key_exists('type', $button) && is_string($button['type'])) {
                        $type = $button['type'];
                    }

                    $htmlButtons[] = Button::widget()->attributes($attributes)->value($value)->type($type)->render();
                }
            } else {
                $htmlButtons[] = $button;
            }
        }

        return implode(PHP_EOL, $htmlButtons);
    }
}
