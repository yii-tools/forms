<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Field;

trait HasClass
{
    /**
     * Returns a new instance with the specified the widget class.
     *
     * @param string $value The widget class.
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
