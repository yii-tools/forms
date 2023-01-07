<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testDirname(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The value cannot be empty.');

        Text::widget([new TestForm(), 'string'])->dirname('')->render();
    }

    /**
     * @throws ReflectionException
     */
    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Yii\Forms\Component\Input\Text widget must be a string or null value.');

        Text::widget([new TestForm(), 'array'])->render();
    }
}
