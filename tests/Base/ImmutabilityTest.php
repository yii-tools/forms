<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Base;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Forms\Tests\Support\TestTrait;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    public function testImmutability(): void
    {
        $formWidget = $this->createWidget();

        $this->assertNotSame($formWidget, $formWidget->attributes([]));
        $this->assertNotSame($formWidget, $formWidget->autofocus());
        $this->assertNotSame($formWidget, $formWidget->class(''));
        $this->assertNotSame($formWidget, $formWidget->id(''));
        $this->assertNotSame($formWidget, $formWidget->name(''));
        $this->assertNotSame($formWidget, $formWidget->tabindex(0));
        $this->assertNotSame($formWidget, $formWidget->title(''));
        $this->assertNotSame($formWidget, $formWidget->value(null));
    }

    private function createWidget(): AbstractFormWidget
    {
        return new class () extends AbstractFormWidget {
            public function render(): string
            {
                return '';
            }
        };
    }
}
