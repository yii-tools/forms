<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use InvalidArgumentException;
use Yii\Forms\Label;
use Yii\Html\Helper\Encode;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;

/**
 * The input element with a type attribute whose value is "checkbox" represents a state or option that can be toggled.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.checkbox.html#input.checkbox
 */
final class Checkbox extends Base\AbstractCheckbox
{
    public function render(): string
    {
        $attributes = $this->attributes;
        $label = $this->label;

        /** @var mixed */
        $value = $this->getValue();

        /** @var mixed */
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

        /** @var mixed */
        $attributes['value'] = is_bool($valueDefault) ? (int) $valueDefault : $valueDefault;

        if ($this->label === '') {
            $label = Encode::content($this->formModel->getLabel($this->attribute));
        }

        $checkboxTag = $this->run('input', '', 'checkbox', $attributes);

        $inputCheckbox = match ($this->label) {
            null => $checkboxTag,
            default => Label::widget([$this->formModel, $this->attribute])
                ->encode(false)
                ->content($checkboxTag . $label)
                ->render(),
        };

        if ($this->verticalAlignment) {
            $inputCheckbox = Tag::create(
                'div',
                Label::widget([$this->formModel, $this->attribute])->content($label)->render() . PHP_EOL . $checkboxTag,
                $this->verticalAlignmentAttributes,
            );
        }

        return match ($this->hidden) {
            null => $inputCheckbox,
            default => $this->hidden
                ->id(null)
                ->name(Utils::generateInputName($this->formModel->getFormName(), $this->attribute))->render() . PHP_EOL .
                $inputCheckbox,
        };
    }
}
