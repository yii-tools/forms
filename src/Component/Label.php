<?php

declare(strict_types=1);

namespace Yii\Forms\Component;

use Closure;
use Yii\Html\Helper\Encode;
use Yii\Html\Helper\Utils;
use Yii\Html\Tag;
use Yii\Widget\Input\Concern;

use function array_key_exists;

/**
 * The Label widget generates a label tag for the specified form model attribute.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/label.html
 */
final class Label extends Field\AbstractFieldPartWidget
{
    use Concern\HasForm;

    private bool $encode = true;

    /**
     * Returns a new instance with the value indicating whether the label should be HTML-encoded.
     *
     * @param bool $value The value indicating whether the label should be HTML-encoded.
     */
    public function encode(bool $value): self
    {
        $new = clone $this;
        $new->encode = $value;

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

        if ($this->encode) {
            $content = Encode::content($content);
        }

        $contentTag = Tag::create('label', $content, $attributes);

        if ($closure instanceof Closure) {
            $contentTag = (string) $closure($this->formModel);
        }

        return $contentTag;
    }
}
