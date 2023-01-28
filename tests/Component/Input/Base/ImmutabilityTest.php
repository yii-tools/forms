<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Base;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\AbstractFormInputWidget;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    public function testImmutability(): void
    {
        $formInputWidget = $this->createWidget();

        $this->assertNotSame($formInputWidget, $formInputWidget->ariaDescribedBy(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->ariaLabel(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->disabled());
        $this->assertNotSame($formInputWidget, $formInputWidget->charset(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->form(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->prefix(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->readonly());
        $this->assertNotSame($formInputWidget, $formInputWidget->required());
        $this->assertNotSame($formInputWidget, $formInputWidget->suffix(''));
    }

    private function createWidget(): AbstractFormInputWidget
    {
        return new class (new TestForm(), 'string') extends AbstractFormInputWidget {
            public function render(): string
            {
                return '';
            }
        };
    }
}
