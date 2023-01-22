<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Exception;
use Yii\Forms\Base;
use Yii\Html\Tag;
use Yiisoft\Widget\Widget;

use function array_merge;
use function implode;
use function is_array;

/**
 * ButtonGroup renders a button group widget.
 *
 * For example,
 *
 * ```php
 * // a button group with items configuration
 * <?= ButtonGroup::create()
 *     ->buttons([
 *         ['label' => 'A'],
 *         ['label' => 'B'],
 *         ['label' => 'C', 'visible' => false],
 *     ]);
 * ?>
 *
 * // button group with an item as a string
 * <?= ButtonGroup::create()
 *     ->buttons([
 *         SubmitButton::create()->content('A')->render(),
 *         ['label' => 'B'],
 *     ]);
 * ?>
 * ```
 *
 * Pressing on the button should be handled via JavaScript. See the following for details:
 */
final class ButtonGroup extends Widget
{
    use Base\HasContainer;

    private array $buttons = [];
    /** @psalm-var array[] */
    private array $individualButtonAttributes = [];

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
     *
     * @return self
     */
    public function buttons(array $values): self
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
     * @return self
     *
     * @psalm-param array[] $values
     */
    public function individualButtonAttributes(array $values = []): self
    {
        $new = clone $this;
        $new->individualButtonAttributes = $values;

        return $new;
    }

    /**
     * @throws Exception
     */
    public function render(): string
    {
        return match ($this->container) {
            true => Tag::create('div', $this->renderButtons(), $this->containerAttributes),
            false => $this->renderButtons(),
        };
    }

    /**
     * Generates the buttons that compound the group as specified on {@see buttons}.
     *
     * @throws Exception
     *
     * @return string the rendering result.
     */
    private function renderButtons(): string
    {
        $htmlButtons = [];

        /** @psalm-var array<string, array|string> $buttons */
        $buttons = $this->buttons;

        foreach ($buttons as $key => $button) {
            if (is_array($button)) {
                /** @psalm-var array $attributes */
                $attributes = $button['attributes'] ?? [];

                // Set individual button attributes.
                $individualButtonAttributes = $this->individualButtonAttributes[$key] ?? [];
                $attributes = array_merge($attributes, $individualButtonAttributes);
                $label = is_string($button['label']) ? $button['label'] : '';
                $type = is_string($button['type']) ? $button['type'] : 'button';
                /** @psalm-var bool $visible */
                $visible = $button['visible'] ?? true;

                if ($visible === false) {
                    continue;
                }

                $htmlButtons[] = Input\Button::widget()->attributes($attributes)->value($label)->type($type)->render();
            } else {
                $htmlButtons[] = $button;
            }
        }

        return implode(PHP_EOL, $htmlButtons);
    }
}
