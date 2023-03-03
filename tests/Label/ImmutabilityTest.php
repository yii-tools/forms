<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Label;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Label;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $label = Label::widget([new TestForm(), 'string']);

        $this->assertNotSame($label, $label->closure(fn () => ''));
        $this->assertNotSame($label, $label->content(''));
        $this->assertNotSame($label, $label->encode(true));
        $this->assertNotSame($label, $label->for(''));
    }
}
