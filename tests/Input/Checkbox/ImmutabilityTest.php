<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;

final class ImmutabilityTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $checkbox = Checkbox::widget([new TestForm(), 'string']);

        $this->assertNotSame($checkbox, $checkbox->hidden(''));
        $this->assertNotSame($checkbox, $checkbox->label(''));
        $this->assertNotSame($checkbox, $checkbox->labelAttributes([]));
        $this->assertNotSame($checkbox, $checkbox->notLabel());
        $this->assertNotSame($checkbox, $checkbox->verticalAlignment());
        $this->assertNotSame($checkbox, $checkbox->verticalAlignmentAttributes([]));
    }
}
