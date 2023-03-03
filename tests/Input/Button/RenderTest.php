<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Button;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Button;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testRender(): void
    {
        $this->assertSame('<input type="button">', Button::widget()->render());
    }
}
