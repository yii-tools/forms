<?php

declare(strict_types=1);

namespace Yii\Forms;

use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;

/**
 * Renders the field widget along with label and hint tag (if any) according to template.
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
