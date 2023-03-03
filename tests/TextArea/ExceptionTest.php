<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\TextArea;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\TextArea;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TextArea::class widget must be a string or null value.');

        TextArea::widget([new TestForm(), 'string'])->attributes(['value' => 1])->render();
    }
}
