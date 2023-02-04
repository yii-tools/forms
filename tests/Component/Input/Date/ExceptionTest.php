<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Date;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Date;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    public function testStep(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The value must be a number.');

        Date::widget([new TestForm(), 'string'])->step('x')->render();
    }

    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Date::class widget must be a string or null value.');

        Date::widget([new TestForm(), 'array'])->render();
    }
}
