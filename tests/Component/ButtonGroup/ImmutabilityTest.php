<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\ButtonGroup;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $buttonGroup = ButtonGroup::widget();

        $this->assertNotSame($buttonGroup, $buttonGroup->buttons([]));
        $this->assertNotSame($buttonGroup, $buttonGroup->container(false));
        $this->assertNotSame($buttonGroup, $buttonGroup->containerAttributes([]));
        $this->assertNotSame($buttonGroup, $buttonGroup->containerClass(''));
        $this->assertNotSame($buttonGroup, $buttonGroup->individualButtonAttributes([]));
    }
}
