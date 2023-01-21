<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Input;

use Yii\Forms\Base\AbstractFormWidget;
use Yii\Html\Attribute;

/**
 * The input element represents a typed data field, usually with a form control to allow the user to edit the data.
 *
 * @link https://www.w3.org/TR/2012/WD-html-markup-20120329/input.html
 */
abstract class AbstractInput extends AbstractFormWidget
{
    use Attribute\CanBeDisabled;
    use Attribute\CanBeReadonly;
    use Attribute\CanBeRequired;
    use Attribute\HasAriaDescribedBy;
    use Attribute\HasAriaLabel;
    use Attribute\HasAutocomplete;
    use Attribute\HasForm;
    use Attribute\HasLists;
    use Attribute\HasValue;
}
