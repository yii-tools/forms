<?php

declare(strict_types=1);

namespace Yii\Forms\Input;

use Yii\Html\Helper\Utils;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "file" represents a list of file items, each consisting of a
 * file name, a file type, and a file body (the contents of the file).
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.file.html#input.file
 */
final class File extends Base\AbstractFile
{
    /**
     * @return string the generated input tag.
     */
    protected function run(): string
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

        $render = $this->renderInput('input', '', 'file', $attributes);

        return match ($this->unchecked) {
            null => $render,
            default => $this->unchecked->name($name)->render() . PHP_EOL . $render,
        };
    }
}
