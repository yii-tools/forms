<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Checkbox;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $checkbox = Checkbox::widget([new TestForm(), 'string']);

        $this->assertNotSame($checkbox, $checkbox->container(false));
        $this->assertNotSame($checkbox, $checkbox->containerAttributes());
        $this->assertNotSame($checkbox, $checkbox->containerClass(''));
        $this->assertNotSame($checkbox, $checkbox->unchecked(''));
    }
}
