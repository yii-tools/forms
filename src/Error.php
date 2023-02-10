<?php

declare(strict_types=1);

namespace Yii\Forms;

use Closure;
use Yii\Html\Tag;

/**
 * The Error widget generates an error content for the specified model attribute.
 */
final class Error extends Field\AbstractFieldPartWidget
{
    public function render(): string
    {
        $closure = $this->closure;
        $content = $this->content;

        if ($content === '') {
            $content = $this->formModel->getFirstError($this->attribute);
        }

        $contentTag = Tag::create($this->tag, $content, $this->attributes);

        if ($closure instanceof Closure) {
            $contentTag = (string) $closure($this->formModel);
        }

        return match ($content !== '') {
            true => $contentTag,
            default => '',
        };
    }
}
