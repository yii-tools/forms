<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use InvalidArgumentException;
use Yii\Forms\Label;
use Yii\Html\Helper\Encode;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * The input element with a type attribute whose value is "checkbox" represents a state or option that can be toggled.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox
 */
final class Checkbox extends Base\AbstractCheckbox
{
    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function render(): string
    {
        $attributes = $this->attributes;
        $label = $this->label;
        $labelTag = Label::widget([$this->formModel, $this->attribute])->attributes($this->labelAttributes);

        /** @psalm-var mixed $value */
        $value = $this->getValue();

        /** @var mixed $valueDefault */
        $valueDefault = $attributes['value'] ?? null;

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox.attrs.value
         */
        if (is_iterable($value) || is_object($value) || is_iterable($valueDefault) || is_object($valueDefault)) {
            throw new InvalidArgumentException('Checkbox::class widget value can not be an iterable or an object.');
        }

        $attributes['checked'] = match (empty($value)) {
            true => $this->checked,
            default => "$value" === "$valueDefault",
        };

        /** @psalm-var mixed */
        $attributes['value'] = is_bool($valueDefault) ? (int) $valueDefault : $valueDefault;

        if ($label === '') {
            $label = Encode::content($this->formModel->getLabel($this->attribute));
        }

        $checkboxTag = $this->run('input', '', 'checkbox', $attributes);

        $inputCheckbox = match ($label) {
            null => $checkboxTag,
            default => $labelTag->encode(false)->content($checkboxTag . $label)->render(),
        };

        if ($this->container && $label !== null) {
            $inputCheckbox = Tag::create(
                'div',
                $labelTag->content($label)->render() . PHP_EOL . $checkboxTag,
                $this->containerAttributes,
            );
        }

        return match ($this->unchecked) {
            null => $inputCheckbox,
            default => $this->unchecked
                ->id(null)
                ->name(Utils::generateInputName($this->formModel->getFormName(), $this->attribute))->render() . PHP_EOL .
                $inputCheckbox,
        };
    }
}
