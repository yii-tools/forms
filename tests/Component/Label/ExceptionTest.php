<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Label;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Label;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

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

        Label::widget([new TestForm(), '']);
    }
}
