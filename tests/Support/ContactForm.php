<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yii\FormModel\AbstractFormModel;

final class ContactForm extends AbstractFormModel
{
    private bool $agree = false;
    private array $attachment = [];
    private string $dateofMessage = '';
    private string $name = '';
    private array $reason = [];
}
