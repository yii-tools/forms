<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Label;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Label;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $label = Label::widget([new TestForm(), 'string']);

        $this->assertNotSame($label, $label->attributes([]));
        $this->assertNotSame($label, $label->closure(fn () => ''));
        $this->assertNotSame($label, $label->content('', false));
        $this->assertNotSame($label, $label->for(''));
    }
}
