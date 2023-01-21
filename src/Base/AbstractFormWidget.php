<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\FormModelInterface;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;
use Yiisoft\Widget\Widget;

use function array_key_exists;
use function is_string;

/**
 * AbstractFormWidget is the base class for widgets that are used to collect user input.
 */
abstract class AbstractFormWidget extends Widget
{
    use Globals;
    use HasPrefixAndSuffix;
    use HasTemplate;

    protected array $attributes = [];
    private string $charset = 'UTF-8';

    public function __construct(protected FormModelInterface $formModel, protected string $attribute)
    {
        if ($this->formModel->has($this->attribute) === false) {
            throw new AttributeNotSet();
        }
    }

    /**
     * Returns a new instance specifying the character encoding of the form submission.
     *
     * @param string $value The character encoding of the form submission.
     */
    public function charset(string $value): static
    {
        $new = clone $this;
        $new->charset = $value;

        return $new;
    }

    /**
     * @return string The attribute of the widget.
     */
    public function getAttribute(): string
    {
        return $this->attribute;
    }

    public function getErrorFirstForAttribute(): string
    {
        return $this->formModel->getFirstError($this->attribute);
    }

    /**
     * @return FormModelInterface The form model of the widget.
     */
    public function getFormModel(): FormModelInterface
    {
        return $this->formModel;
    }

    /**
     * @return string The ID of the widget.
     */
    public function getId(): string
    {
        return match (isset($this->attributes['id']) && is_string($this->attributes['id'])) {
            true => $this->attributes['id'],
            false => Utils::generateInputId($this->formModel->getFormName(), $this->attribute),
        };
    }

    /**
     * @return bool Whether the widget is valid.
     */
    public function isValidated(): bool
    {
        return !$this->isEmpty() && !$this->hasError();
    }

    /**
     * @return bool Whether the widget has an error.
     */
    public function hasError(): bool
    {
        return $this->formModel->hasError($this->attribute);
    }

    /**
     * @return string The placeholder of the widget.
     */
    protected function getPlaceholder(): string
    {
        return $this->formModel->getPlaceholder($this->attribute);
    }

    /**
     * @return mixed The value of the widget.
     */
    protected function getValue(): mixed
    {
        return $this->formModel->getAttributeValue($this->attribute);
    }

    protected function run(string $tag, string $content, string|null $type, array $attributes): string
    {
        $attributes['type'] = $type;
        $prefix = $this->prefix;
        $suffix = $this->suffix;

        if ($prefix !== '') {
            $prefix .= PHP_EOL;
        }

        if (!array_key_exists('id', $attributes)) {
            $attributes['id'] = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        }

        if (!array_key_exists('name', $attributes)) {
            $attributes['name'] = Utils::generateInputName($this->formModel->getFormName(), $this->attribute);
        }

        if ($suffix !== '') {
            $suffix = PHP_EOL . $suffix . PHP_EOL;
        }

        return strtr(
            $this->template,
            [
                '{prefix}' => $prefix,
                '{input}' => Tag::create($tag, $content, $attributes),
                '{suffix}' => $suffix,
            ],
        );
    }

    /**
     * @return bool Whether the widget is empty.
     */
    private function isEmpty(): bool
    {
        return $this->formModel->isEmpty();
    }
}
