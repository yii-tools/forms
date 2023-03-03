<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Button;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Button;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Button::class widget must be a string or null value.');

        Button::widget()->value([])->render();
    }
}
