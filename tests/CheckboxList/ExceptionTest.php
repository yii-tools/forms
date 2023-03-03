<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CheckboxList;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testContainer(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('The container tag must be a non-empty string.');

        CheckboxList::widget([new TestForm(), 'string'])
            ->containerTag('')
            ->items([0 => 'inactive', 1 => 'active'])
            ->render();
    }

    public function testValue(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('CheckboxList::class widget must be a array or null value.');

        CheckboxList::widget([new TestForm(), 'string'])->items([0 => 'inactive', 1 => 'active'])->render();
    }
}
