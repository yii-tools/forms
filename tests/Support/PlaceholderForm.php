<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\Forms\FormModelInterface;
use Yii\FormModel\AbstractFormModel;

final class PlaceholderForm extends AbstractFormModel implements FormModelInterface
{
    private string $text = '';

    public function getPlaceHolders(): array
    {
        return [
            'text' => 'Enter your text',
        ];
    }
}
