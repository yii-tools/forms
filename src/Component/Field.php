<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use ReflectionException;
use Stringable;
use Yii\Forms\Base;
use Yii\Forms\FieldAttribute;
use Yii\Forms\Widget;
use Yii\Html\Tag;

/**
 * Renders the field widget along with label and hint tag (if any) according to template.
 */
final class Field extends \Yiisoft\Widget\Widget
{
    use Base\FieldError;
    use Base\FieldHint;
    use Base\FieldLabel;
    use FieldAttribute\After;
    use FieldAttribute\AfterInput;
    use FieldAttribute\Before;
    use FieldAttribute\BeforeInput;
    use FieldAttribute\Classes;
    use FieldAttribute\Container;
    use FieldAttribute\ContainerAttributes;
    use FieldAttribute\InputContainer;
    use FieldAttribute\InputContainerAttributes;
    use FieldAttribute\InputTemplate;
    use FieldAttribute\InvalidClass;
    use FieldAttribute\Template;
    use FieldAttribute\ValidClass;

    protected array $attributes = [];
    private bool|string $ariaDescribedBy = false;
    private string $inputId = '';

    public function __construct(private Base\AbstractFormWidget $widget)
    {
    }

    public function render(): string|Stringable
    {
        return match ($this->container) {
            true => Tag::create('div', $this->renderWidget(), $this->getContainerAttributes()),
            false => $this->renderWidget(),
        };
    }

    /**
     * @throws ReflectionException
     */
    private function renderError(string $errorMessage = ''): string|Stringable
    {
        if ($this->errorMessage !== '') {
            $errorMessage = $this->errorMessage;
        }

        $errorTag = Widget\Error::widget([$this->widget->getFormModel(), $this->widget->getAttribute()])
            ->attributes($this->errorAttributes)
            ->message($errorMessage)
            ->tag($this->errorTag);

        if (is_callable($this->errorCallback)) {
            $errorTag = $errorTag->callback($this->errorCallback);
        }

        return $errorTag->render();
    }

    /**
     * @throws ReflectionException
     */
    private function renderHint(): string|Stringable
    {
        $hintAttributes = $this->hintAttributes;

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $hintAttributes['id'] = $this->inputId . '-help';
        }

        if (is_string($this->ariaDescribedBy) && $this->ariaDescribedBy !== '') {
            $hintAttributes['id'] = $this->ariaDescribedBy;
        }

        return Widget\Hint::widget([$this->widget->getFormModel(), $this->widget->getAttribute()])
            ->attributes($hintAttributes)
            ->message($this->hintMessage)
            ->tag($this->hintTag)
            ->render();
    }

    /**
     * @throws ReflectionException
     */
    protected function renderLabel(): string|Stringable
    {
        $labelAttributes = $this->labelAttributes;

        if (!array_key_exists('for', $labelAttributes)) {
            $labelAttributes['for'] = $this->widget->getInputId();
        }

        return Widget\Label::widget([$this->widget->getFormModel(), $this->widget->getAttribute()])
            ->attributes($labelAttributes)
            ->content($this->labelMessage)
            ->render();
    }

    /**
     * @throws ReflectionException
     */
    protected function renderWidget(): string
    {
        $errorMessage = '';
        $widget = $this->widget;

        if (is_bool($this->ariaDescribedBy) && $this->ariaDescribedBy === true) {
            $widget = $widget->attributes(['aria-describedby' => $this->inputId . '-help']);
        }

        if ($this->class !== '') {
            $widget = $widget->class($this->class);
        }

        if ($widget->hasError()) {
            $errorMessage = $widget->getErrorFirstForAttribute();
            $widget = $widget->class($this->invalidClass);
        } elseif ($widget->isValidated()) {
            $widget = $widget->class($this->validClass);
        }

        $fieldTag = $this->renderField($widget);

        return preg_replace(
            '/^\h*\v+/m',
            '',
            trim(
                strtr(
                    $this->template,
                    [
                        '{error}' => $this->renderError($errorMessage),
                        '{field}' => $fieldTag,
                        '{hint}' => $this->renderHint(),
                        //'{label}' => $labelTag,
                    ],
                ),
            ),
        );
    }

    private function renderField(Base\AbstractFormWidget $widget): string
    {
        $inputTag = '';
        $labelContent = (string) $this->renderLabel();
        $labelTag = match ($this->labelContainer) {
            true => Tag::create('div', $labelContent, $this->labelContainerAttributes),
            false => $labelContent,
        };
        $widgetContent = $widget->render();

        if ($this->before !== '') {
            $inputTag .= $this->before . PHP_EOL;
        }

        if ($widgetContent !== '') {
            $widgetContent = strtr(
                $this->inputTemplate,
                [
                    '{beforeInput}' => $this->beforeInput,
                    '{label}' => $labelTag,
                    '{input}' => $widgetContent,
                    '{afterInput}' => $this->afterInput,
                ],
            );

            $inputTag .= match ($this->inputContainer) {
                true => Tag::create('div', $widgetContent, $this->inputContainerAttributes),
                false => $widgetContent,
            };
        }

        if ($this->after !== '') {
            $inputTag .= PHP_EOL . $this->after . PHP_EOL;
        }

        return $inputTag;
    }
}
