<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use InvalidArgumentException;
use Yii\Forms\Base\Globals;
use Yii\Html\Attribute;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;
use Yiisoft\Widget\Widget;

use function array_key_exists;
use function is_string;

/**
 * The input element with a type attribute whose value is "button" represents a button with no additional semantics.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button
 */
final class Button extends Widget
{
    use Attribute\CanBeDisabled;
    use Attribute\HasAttributes;
    use Attribute\HasForm;
    use Attribute\HasType;
    use Attribute\HasValue;
    use Globals;

    protected array $attributes = [];

    public function render(): string
    {
        $attributes = $this->attributes;
        $value = $attributes['value'] ?? null;

        /**
         * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.button.html#input.button.attrs.value
         */
        if (null !== $value && !is_string($value)) {
            throw new InvalidArgumentException(
                Utils::shortNameClass(self::class) . ' widget must be a string or null value.',
            );
        }

        if (!array_key_exists('type', $attributes)) {
            $attributes['type'] = 'button';
        }

        $attributes['value'] = $value;

        return Tag::create('input', '', $attributes);
    }
}
