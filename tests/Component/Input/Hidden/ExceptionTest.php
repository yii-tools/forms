<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Hidden;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;
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
        $this->expectExceptionMessage('Hidden::class widget must be a string or null value.');

        Hidden::widget([new TestForm(), 'array'])->render();
    }
}
