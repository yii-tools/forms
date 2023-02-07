<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use Yii\Html\Helper\Utils;
use Yii\Widget\Attribute;
use Yii\Widget\Input\AbstractInputWidget;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "file" represents a list of file items, each consisting of a
 * file name, a file type, and a file body (the contents of the file).
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.file.html#input.file
 */
final class File extends AbstractInputWidget
{
    use Attribute\CanBeMultiple;
    use Attribute\HasAccept;

    private Hidden|null $hidden = null;

    /**
     * Returns a new instance with hidden widget that corresponds to "unchecked" state of the input.
     *
     * @param string $value The value of the "unchecked" state.
     * @param array $values The Attribute values indexed by attribute names for hidden widget.
     *
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotInstantiableException
     * @throws NotFoundException
     */
    public function hidden(string $value, array $values = []): self
    {
        $values['value'] = $value;

        $new = clone $this;
        $new->hidden = Hidden::widget([$this->formModel, $this->attribute])->attributes($values);

        return $new;
    }

    /**
     * @return string the generated input tag.
     */
    public function render(): string
    {
        $attributes = $this->attributes;

        if (!array_key_exists('name', $attributes)) {
            $name = Utils::generateInputName($this->formModel->getFormName(), $this->attribute);
        } else {
            $name = is_string($attributes['name']) ? $attributes['name'] : '';
        }

        $attributes['name'] = Utils::generateArrayableName($name);


        // input type="file" not supported value attribute.
        unset($attributes['value']);

        $render = $this->run('input', '', 'file', $attributes);

        return match ($this->hidden) {
            null => $render,
            default => $this->hidden->name($name)->render() . PHP_EOL . $render,
        };
    }
}
