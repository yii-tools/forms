<?php

declare(strict_types=1);

namespace Yii\Forms\FieldAttribute;

trait Classes
{
    private string $class = '';

    /**
     * Returns a new instance with the specified the widget class.
     *
     * @param string $class The widget class.
     *
     * @link https://html.spec.whatwg.org/#classes
     */
    public function class(string $value): static
    {
        $new = clone $this;
        $new->class = $value;

        return $new;
    }
}
