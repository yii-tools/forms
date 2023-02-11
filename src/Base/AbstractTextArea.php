<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Widget\AbstractInputWidget;
use Yii\Widget\Attribute;

abstract class AbstractTextArea extends AbstractInputWidget
{
    use Attribute\HasAutocomplete;
    use Attribute\HasCols;
    use Attribute\HasDirname;
    use Attribute\HasMaxLength;
    use Attribute\HasMinLength;
    use Attribute\HasPlaceholder;
    use Attribute\HasRows;
    use Attribute\HasWrap;

    /**
     * Returns a new instance specifying the initial contents of the control.
     *
     * @param string $value The initial contents of the control.
     */
    public function content(string $value): self
    {
        $new = clone $this;
        $new->attributes['value'] = $value;

        return $new;
    }
}
