<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Closure;
use Yii\Html\Tag;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;
use Yiisoft\Widget\Widget;

use function array_key_exists;
use function is_bool;
use function is_string;
use function preg_replace;
use function strtr;

/**
 * Renders the field widget along with label and hint tag (if any) according to template.
 */
final class Field extends Widget
{
    use Field\HasFieldClass;
    use Field\HasFieldError;
    use Field\HasFieldHint;
    use Field\HasFieldInputContainer;
    use Field\HasFieldInputTemplate;
    use Field\HasFieldLabel;
    use Field\HasFieldTemplate;
    use Field\HasFieldValidateClass;
    use Input\Base\HasContainer;
    use Input\Base\HasPrefixAndSuffix;

    protected array $attributes = [];
    private bool|string $ariaDescribedBy = false;
    private string $class = '';
    private string $inputId = '';

    public function __construct(private readonly Input\AbstractFormInputWidget|Widget $widget)
    {
    }

    /**
     * Return new instance with specified aria-describedby attribute.
     *
     * @param bool|string $ariaDescribedBy The value of the aria-describedby attribute.
     */
    public function ariaDescribedBy(bool|string $ariaDescribedBy): self
    {
        $new = clone $this;
        $new->ariaDescribedBy = $ariaDescribedBy;

        return $new;
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function render(): string
    {
        $renderWidget = match ($this->widget instanceof Input\AbstractFormInputWidget) {
            true => $this->renderWidget($this->widget),
            false => $this->widget->render(),
        };

        return match ($this->container) {
            true => Tag::create('div', $renderWidget, $this->getContainerAttributes()),
            false => $renderWidget,
        };
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderError(Input\AbstractFormInputWidget $widget, string $errorContent = ''): string
    {
        if ($this->errorContent !== '') {
            $errorContent = $this->errorContent;
        }

        $errorTag = Error::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($this->errorAttributes)
            ->content($errorContent)
            ->tag($this->errorTag);

        if ($this->errorClosure instanceof Closure) {
            $errorTag = $errorTag->closure($this->errorClosure);
        }

        return $errorTag->render();
    }

    /**
     * Renders the input widget for the field.
     */
    private function renderInput(Input\AbstractFormInputWidget $widget, string $label): string
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderHint(Input\AbstractFormInputWidget $widget): string
    {
        $hintAttributes = $this->hintAttributes;

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $hintAttributes['id'] = $widget->getId() . '-help';
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $hintAttributes['id'] = $this->ariaDescribedBy;
        }

        $hintTag = Hint::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($hintAttributes)
            ->content($this->hintContent)
            ->tag($this->hintTag);

        if ($this->hintClosure instanceof Closure) {
            $hintTag = $hintTag->closure($this->hintClosure);
        }

        return $hintTag->render();
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderLabel(Input\AbstractFormInputWidget $widget): string
    {
        $labelAttributes = $this->labelAttributes;

        if (!array_key_exists('for', $labelAttributes)) {
            $labelAttributes['for'] = $widget->getId();
        }

        $labelTag = Label::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($labelAttributes)
            ->content($this->labelContent);

        if ($this->labelClosure instanceof Closure) {
            $labelTag = $labelTag->closure($this->labelClosure);
        }

        return $labelTag->render();
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderWidget(Input\AbstractFormInputWidget $widget): string
    {
        $errorContent = '';
        $label = '';

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $widget = $widget->attributes(['aria-describedby' => $widget->getId() . '-help']);
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $widget = $widget->attributes(['aria-describedby' => $this->ariaDescribedBy]);
        }

        $widget = $widget->class($this->class);

        if ($widget->hasError()) {
            $errorContent = $widget->getErrorFirstForAttribute();
            $widget = $widget->class($this->invalidClass);
        } elseif ($widget->isValidated()) {
            $widget = $widget->class($this->validClass);
        }

        $error = $this->renderError($widget, $errorContent);
        $hint = $this->renderHint($widget);

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
}
