<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\Forms\Concern\HasError;
use Yii\Forms\Concern\HasHint;
use Yii\Forms\Concern\HasLabel;
use Yii\Forms\Concern\HasPlaceholder;
use Yii\Forms\FormModelInterface;
use Yii\Model\AbstractModel;

abstract class AbstractFormModel extends AbstractModel implements FormModelInterface
{
    use HasError;
    use HasHint;
    use HasLabel;
    use HasPlaceholder;
}
