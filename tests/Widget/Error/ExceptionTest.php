<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Widget\Error;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Error;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testConstruct(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        Error::widget([new TestForm(), '']);
    }

    /**
     * @throws ReflectionException
     */
    public function testTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Error::widget([new TestForm(), 'string'])->tag('')->render();
    }
}
