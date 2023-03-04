<?php

declare(strict_types=1);

namespace Yii\Forms;

use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;

/**
 * Renders the field along with `label`, `hint`, `error`, `prefix`, `suffix`, and `container`.
 */
final class Field extends Base\AbstractField
{
    protected function run(): string
    {
        $renderWidget = match ($this->widget instanceof AbstractInputWidget) {
            true => $this->renderWidget($this->widget),
            false => $this->widget->render(),
        };

        return match ($this->container) {
            true => Tag::create('div', $renderWidget, $this->containerAttributes),
            false => $renderWidget,
        };
    }
}
