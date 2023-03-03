<?php

declare(strict_types=1);

namespace Yii\Forms;

use Exception;
use Yii\Html\Tag;

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
final class ButtonGroup extends Base\AbstractButtonGroup
{
    /**
     * @throws Exception
     */
    protected function run(): string
    {
        return match ($this->container) {
            true => Tag::create('div', $this->renderButtons(), $this->containerAttributes),
            false => $this->renderButtons(),
        };
    }
}
