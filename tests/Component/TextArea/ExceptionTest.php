<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testContent(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('TextArea widget must be a string or null value.');

        TextArea::widget([new PropertyTypeForm(), 'string'])->attributes(['value' => 1])->render();
    }

    /**
     * @throws ReflectionException
     */
    public function testWrap(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid wrap value. Valid values are: hard, soft.');

        TextArea::widget([new PropertyTypeForm(), 'string'])->wrap('')->render();
    }
}
