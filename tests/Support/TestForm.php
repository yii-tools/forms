<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\Forms\FormModelInterface;
use Yii\FormModel\AbstractFormModel;

final class TestForm extends AbstractFormModel implements FormModelInterface
{
    private array $array = [];
    private string $mĄkA = '';
    private string|null $string = '';

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
