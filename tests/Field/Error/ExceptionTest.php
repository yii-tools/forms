<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field\Error;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Field\Error;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        Error::widget([new TestForm(), '']);
    }

    public function testTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Error::widget([new TestForm(), 'string'])->tag('');
    }
}
