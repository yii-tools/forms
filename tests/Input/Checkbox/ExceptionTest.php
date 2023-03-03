<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Checkbox::class widget value can not be an iterable or an object.');

        Checkbox::widget([new TestForm(), 'array'])->render();
    }
}
