<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\FormModel\AbstractFormModel;

final class BasicForm extends AbstractFormModel
{
    private string $amount = '';
    private string $email = '';
    private string $url = '';
    private string $username = '';
    private string $server = '';
    private string $textArea = '';
}
