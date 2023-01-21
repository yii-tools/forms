<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Base;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Forms\FormModelInterface;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityGlobalsTest extends TestCase
{
    public function testImmutability(): void
    {
        $globals = $this->createWidget(new TestForm());

        $this->assertNotSame($globals, $globals->attributes([]));
        $this->assertNotSame($globals, $globals->autoFocus());
        $this->assertNotSame($globals, $globals->class(''));
        $this->assertNotSame($globals, $globals->charset(''));
        $this->assertNotSame($globals, $globals->id(''));
        $this->assertNotSame($globals, $globals->name(''));
        $this->assertNotSame($globals, $globals->tabindex(0));
        $this->assertNotSame($globals, $globals->template(''));
        $this->assertNotSame($globals, $globals->title(''));
    }

    private function createWidget(FormModelInterface $formModel): AbstractFormWidget
    {
        return new class ($formModel, 'string') extends AbstractFormWidget {
            public function render(): string
            {
                return '';
            }
        };
    }
}
