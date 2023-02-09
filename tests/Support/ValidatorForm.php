<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\FormModel\AbstractFormModel;
use Yii\Validator\HasValidate;
use Yiisoft\Validator\Rule\Length;
use Yiisoft\Validator\Rule\Regex;
use Yiisoft\Validator\Rule\Required;

final class ValidatorForm extends AbstractFormModel
{
    use HasValidate;

    private string $username = '';

    public function getRules(): array
    {
        return [
            'username' => [
                new Required(),
                new Length(min: 3, max: 10),
                new Regex('/^[a-z]+$/'),
            ],
        ];
    }
}
