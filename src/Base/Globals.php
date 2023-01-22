<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Attribute;

/**
 * Globals implements the common attributes for all form elements.
 */
trait Globals
{
    use Attribute\CanBeAutofocus;
    use Attribute\HasAttributes;
    use Attribute\HasClass;
    use Attribute\HasId;
    use Attribute\HasName;
    use Attribute\HasTabindex;
    use Attribute\HasTitle;
}
