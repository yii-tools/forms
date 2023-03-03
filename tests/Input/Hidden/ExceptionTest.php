<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Hidden;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testAutofocus(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Hidden::class widget must not be autofocus, required, readonly, tabindex or title attribute.'
        );

        Hidden::widget([new TestForm(), 'string'])->autofocus()->render();
    }

    public function testRequired(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Hidden::class widget must not be autofocus, required, readonly, tabindex or title attribute.'
        );

        Hidden::widget([new TestForm(), 'string'])->required()->render();
    }

    public function testReadonly(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Hidden::class widget must not be autofocus, required, readonly, tabindex or title attribute.'
        );

        Hidden::widget([new TestForm(), 'string'])->readonly()->render();
    }

    public function testTabindex(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Hidden::class widget must not be autofocus, required, readonly, tabindex or title attribute.'
        );

        Hidden::widget([new TestForm(), 'string'])->tabindex(1)->render();
    }

    public function testTitle(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'Hidden::class widget must not be autofocus, required, readonly, tabindex or title attribute.'
        );

        Hidden::widget([new TestForm(), 'string'])->title('test-title')->render();
    }

    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Hidden::class widget must be a string or null value.');

        Hidden::widget([new TestForm(), 'array'])->render();
    }
}
