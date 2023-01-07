<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\Model\AbstractFormModel;

final class TestForm extends AbstractFormModel
{
    private array $array = [];
    private string|null $string = '';

    public function customErrorCallback(): string
    {
        return 'Custom error';
    }

    public function getHints(): array
    {
        return [
            'string' => 'String hint.',
        ];
    }
}
