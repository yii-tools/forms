<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Closure;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\FormModelInterface;
use Yii\Html\Attribute\Form;
use Yii\Html\Helper\Encode;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;
use Yiisoft\Widget\Widget;

use function array_key_exists;

/**
 * The Label widget generates a label tag for the specified form model attribute.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/label.html
 */
final class Label extends Widget
{
    use Form;

    private array $attributes = [];
    private Closure|null $closure = null;
    private string $content = '';

    public function __construct(private readonly FormModelInterface $formModel, private readonly string $attribute = '')
    {
        if ($this->formModel->has($this->attribute) === false) {
            throw new AttributeNotSet();
        }
    }

    /**
     * The HTML attributes. The following special options are recognized.
     *
     * @param array $values Attribute values indexed by attribute names.
     */
    public function attributes(array $values): self
    {
        $new = clone $this;
        $new->attributes = $values;

        return $new;
    }

    /**
     * Returns a new instance with closure that will be called to obtain a label content.
     *
     * @param Closure $value The closure that will be called to obtain a label content.
     */
    public function closure(Closure $value): self
    {
        $new = clone $this;
        $new->closure = $value;

        return $new;
    }

    /**
     * Returns a new instance specifying the label to be displayed.
     *
     * @param string $content The label to be displayed.
     * @param bool $encode Whether to encode the label.
     */
    public function content(string $content, bool $encode = true): self
    {
        $new = clone $this;
        $new->content = $encode ? Encode::content($content) : $content;

        return $new;
    }

    /**
     * Returns a new instance with the id of a labelable form-related element in the same document as the tag label
     * element.
     *
     * The first element in the document with an id matching the value of the for attribute is the labeled control for
     * this label element, if it is a labelable element.
     *
     * @param string $value The id of a labelable form-related element in the same document as the tag label
     * element. If null, the attribute will be removed.
     *
     * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/label.html#label.attrs.for
     */
    public function for(string $value): self
    {
        $new = clone $this;
        $new->attributes['for'] = $value;

        return $new;
    }

    public function render(): string
    {
        $attributes = $this->attributes;
        $closure = $this->closure;
        $content = $this->content;

        if ($content === '') {
            $content = Encode::content($this->formModel->getLabel($this->attribute));
        }

        if (!array_key_exists('for', $attributes)) {
            $attributes['for'] = Utils::generateInputId($this->formModel->getFormName(), $this->attribute);
        }

        $contentTag = Tag::create('label', $content, $attributes);

        if ($closure instanceof Closure) {
            $contentTag = (string) $closure($this->formModel);
        }

        return $contentTag;
    }
}
