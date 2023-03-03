<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Text;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Text::class widget must be a string or null value.');

        Text::widget([new TestForm(), 'array'])->render();
    }
}
