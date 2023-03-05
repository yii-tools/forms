<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Closure;
use Yii\Forms\Field;
use Yii\Forms\Field\Concern;
use Yii\Forms\Input;
use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\AbstractWidget;
use Yii\Widget\Attribute;

use function array_key_exists;
use function is_bool;
use function is_string;
use function preg_replace;
use function strtr;

abstract class AbstractField extends AbstractWidget
{
    use Attribute\HasContainer;
    use Attribute\HasPrefixAndSuffix;
    use Concern\HasFieldClass;
    use Concern\HasFieldError;
    use Concern\HasFieldHint;
    use Concern\HasFieldInputContainer;
    use Concern\HasFieldInputTemplate;
    use Concern\HasFieldLabel;
    use Concern\HasFieldTemplate;
    use Concern\HasFieldValidateClass;

    protected bool|string $ariaDescribedBy = false;
    protected string $class = '';

    public function __construct(protected readonly AbstractInputWidget|AbstractWidget $widget)
    {
    }

    /**
     * Return new instance with specified aria-describedby attribute.
     *
     * @param bool|string $ariaDescribedBy The value of the aria-describedby attribute.
     */
    public function ariaDescribedBy(bool|string $ariaDescribedBy): static
    {
        $new = clone $this;
        $new->ariaDescribedBy = $ariaDescribedBy;

        return $new;
    }

    protected function renderWidget(AbstractInputWidget $widget): string
    {
        $label = '';

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $widget = $widget->attributes(['aria-describedby' => $widget->getId() . '-help']);
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $widget = $widget->attributes(['aria-describedby' => $this->ariaDescribedBy]);
        }

        $widget = $widget->class($this->class);

        if ($widget->hasError()) {
            $widget = $widget->class($this->invalidClass);
        } elseif ($widget->isValidated()) {
            $widget = $widget->class($this->validClass);
        }

        $error = $this->renderError($widget);
        $hint = $this->renderHint($widget);

        if ($widget instanceof Input\Checkbox && str_contains($this->inputTemplate, '{label}')) {
            $widget = $widget->notLabel();
        }

        if ($widget instanceof Input\Hidden === false && $this->isLabel()) {
            $label = $this->renderLabel($widget);
        }

        return preg_replace(
            '/^\h*\v+/m',
            '',
            trim(
                strtr(
                    $this->template,
                    [
                        '{error}' => $error,
                        '{field}' => $this->renderInput($widget, $label),
                        '{hint}' => $hint,
                        '{label}' => $label,
                        '{prefix}' => $this->prefix,
                        '{suffix}' => $this->suffix,
                    ],
                ),
            ),
        );
    }

    private function renderError(AbstractInputWidget $widget): string
    {
        $errorTag = Field\Error::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($this->errorAttributes)
            ->content($this->errorContent)
            ->showAllErrors($this->showAllErrors)
            ->tag($this->errorTag);

        if ($this->errorClosure instanceof Closure) {
            $errorTag = $errorTag->closure($this->errorClosure);
        }

        return $errorTag->render();
    }

    /**
     * Renders the input widget for the field.
     */
    private function renderInput(AbstractInputWidget $widget, string $label): string
    {
        $render = '';
        $renderWidget = $widget->render();

        if ($renderWidget !== '') {
            $renderInput = strtr(
                $this->inputTemplate,
                [
                    '{input}' => $renderWidget,
                    '{label}' => $label,
                ],
            );

            $render = match ($this->inputContainer) {
                true => Tag::create('div', $renderInput, $this->inputContainerAttributes),
                false => $renderInput,
            };
        }

        return $render;
    }

    private function renderHint(AbstractInputWidget $widget): string
    {
        $hintAttributes = $this->hintAttributes;

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $hintAttributes['id'] = $widget->getId() . '-help';
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $hintAttributes['id'] = $this->ariaDescribedBy;
        }

        $hintTag = Field\Hint::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($hintAttributes)
            ->content($this->hintContent)
            ->tag($this->hintTag);

        if ($this->hintClosure instanceof Closure) {
            $hintTag = $hintTag->closure($this->hintClosure);
        }

        return $hintTag->render();
    }

    private function renderLabel(AbstractInputWidget $widget): string
    {
        $labelAttributes = $this->labelAttributes;

        if (!array_key_exists('for', $labelAttributes)) {
            $labelAttributes['for'] = $widget->getId();
        }

        $labelTag = Field\Label::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($labelAttributes)
            ->content($this->labelContent)
            ->encode($this->labelEncode);

        if ($this->labelClosure instanceof Closure) {
            $labelTag = $labelTag->closure($this->labelClosure);
        }

        return $labelTag->render();
    }
}
