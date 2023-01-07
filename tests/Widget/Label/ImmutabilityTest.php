<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Widget\Label;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Label;

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
        $this->assertNotSame($label, $label->content('', false));
        $this->assertNotSame($label, $label->for(''));
    }
}
