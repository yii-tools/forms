<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\ButtonGroup;

use PHPUnit\Framework\TestCase;
use Yii\Forms\ButtonGroup;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $buttonGroup = ButtonGroup::widget();

        $this->assertNotSame($buttonGroup, $buttonGroup->buttons([]));
        $this->assertNotSame($buttonGroup, $buttonGroup->individualButtonAttributes());
    }
}
