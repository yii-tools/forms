<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Button;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;

final class ButtonTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame('<input type="button">', Button::widget()->render());
    }
}
