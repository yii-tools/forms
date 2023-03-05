<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field\Label;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Field\Label;
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

        Label::widget([new TestForm(), '']);
    }
}
