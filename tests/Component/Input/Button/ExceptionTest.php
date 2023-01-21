<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Button;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Button::class widget must be a string or null value.');

        Button::widget()->value([])->render();
    }
}
