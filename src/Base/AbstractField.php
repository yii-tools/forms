<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Closure;
use Yii\Forms;
use Yii\Forms\Field;
use Yii\Html\Tag;
use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;
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

abstract class AbstractField extends Widget
{
    use Attribute\HasContainer;
    use Attribute\HasPrefixAndSuffix;
    use Field\HasFieldClass;
    use Field\HasFieldError;
    use Field\HasFieldHint;
    use Field\HasFieldInputContainer;
    use Field\HasFieldInputTemplate;
    use Field\HasFieldLabel;
    use Field\HasFieldTemplate;
    use Field\HasFieldValidateClass;

    protected array $attributes = [];
    protected bool|string $ariaDescribedBy = false;
    protected string $class = '';

    public function __construct(protected readonly AbstractInputWidget|Widget $widget)
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

        if ($widget instanceof Forms\Input\Hidden === false && $this->isLabel()) {
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderError(AbstractInputWidget $widget): string
    {
        $errorContent = match ($this->showAllErrors) {
            true => $widget->getErrorsForAttribute(),
            default => $widget->getErrorFirstForAttribute(),
        };

        if ($this->errorContent !== '') {
            $errorContent = $this->errorContent;
        }

        $errorTag = Forms\Error::widget([$widget->getFormModel(), $widget->getAttribute()])
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    private function renderHint(AbstractInputWidget $widget): string
    {
        $hintAttributes = $this->hintAttributes;

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $hintAttributes['id'] = $widget->getId() . '-help';
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $hintAttributes['id'] = $this->ariaDescribedBy;
        }

        $hintTag = Forms\Hint::widget([$widget->getFormModel(), $widget->getAttribute()])
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
    private function renderLabel(AbstractInputWidget $widget): string
    {
        $labelAttributes = $this->labelAttributes;

        if (!array_key_exists('for', $labelAttributes)) {
            $labelAttributes['for'] = $widget->getId();
        }

        $labelTag = Forms\Label::widget([$widget->getFormModel(), $widget->getAttribute()])
            ->attributes($labelAttributes)
            ->content($this->labelContent);

        if ($this->labelClosure instanceof Closure) {
            $labelTag = $labelTag->closure($this->labelClosure);
        }

        return $labelTag->render();
    }
}
