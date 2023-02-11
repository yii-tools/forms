<?php

declare(strict_types=1);

namespace Yii\Forms;

use Yii\Html\Tag;
use Yii\Widget\Input\AbstractInputWidget;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * Renders the field widget along with label and hint tag (if any) according to template.
 */
final class Field extends Base\AbstractField
{
    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function render(): string
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
