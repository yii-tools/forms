<?php

declare(strict_types=1);

namespace Yii\Forms\Field;

use Closure;
use Yii\Html\Tag;

/**
 * Get an error content for the specified model attribute.
 */
final class Error extends AbstractFieldPartWidget
{
    private bool $showAllErrors = false;

    /**
     * Return a new instance with specified if they show all errors or the first error by attribute if it exists.
     *
     * @param bool $value If they show all errors or the first error by attribute if it exists.
     */
    public function showAllErrors(bool $value): self
    {
        $new = clone $this;
        $new->showAllErrors = $value;

        return $new;
    }

    protected function run(): string
    {
        $closure = $this->closure;
        $content = $this->content;
        $errorContent = $this->getErrorFromModel();

        if ($content !== '') {
            $content = Tag::create($this->tag, $content, $this->attributes);
        }

        if ($content === '' && $errorContent !== '') {
            $content = Tag::create($this->tag, $errorContent, $this->attributes);
        }

        if ($closure instanceof Closure) {
            $content = (string) $closure($this->formModel);
        }

        return match ($content !== '') {
            true => $content,
            default => '',
        };
    }

    private function getErrorFromModel(): string
    {
        if ($this->formModel->hasError($this->attribute) === false) {
            return '';
        }

        return match ($this->showAllErrors) {
            true => implode('<br>', $this->formModel->getError($this->attribute)),
            default => $this->formModel->getFirstError($this->attribute),
        };
    }
}
