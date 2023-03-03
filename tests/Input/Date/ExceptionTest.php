<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Date;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Date;
use Yii\Forms\Tests\Support\TestForm;

final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Date::class widget must be a string or null value.');

        Date::widget([new TestForm(), 'array'])->render();
    }
}
