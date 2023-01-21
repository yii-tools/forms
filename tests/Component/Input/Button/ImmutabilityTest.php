<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Button;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $button = Button::widget();
        $this->assertNotSame($button, $button->attributes([]));
        $this->assertNotSame($button, $button->type(''));
    }
}
