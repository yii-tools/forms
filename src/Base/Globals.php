<?php

declare(strict_types=1);

namespace Yii\Forms\Base;

use Yii\Html\Attribute;

/**
 * Globals trait implements the common attributes for all form elements.
 */
trait Globals
{
    use Attribute\Attributes;
    use Attribute\Autofocus;
    use Attribute\Classes;
    use Attribute\Id;
    use Attribute\Name;
    use Attribute\Tabindex;
    use Attribute\Title;
}
