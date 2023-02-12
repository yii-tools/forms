<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\FormModel\AbstractFormModel;

final class TestForm extends AbstractFormModel
{
    private array|null $array = [];
    private bool|null $bool = false;
    private int $int = 0;
    private string $mĄkA = '';
    private string|null $string = '';
    private object|null $object = null;

    public function customErrorCallback(): string
    {
        return 'Custom error';
    }

    public function getHints(): array
    {
        return [
            'string' => 'String hint',
        ];
    }

    public function getLabels(): array
    {
        return [
            'string' => 'String',
        ];
    }
}
