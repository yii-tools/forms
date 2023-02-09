<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\FormModel\AbstractFormModel;
use Yii\Validator\HasValidate;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;

final class ValidatorFormAttributes extends AbstractFormModel
{
    use HasValidate;

    #[Required, Length(min: 3, max: 10), Regex('/^[a-z]+$/')]
    private string $username = '';
}
