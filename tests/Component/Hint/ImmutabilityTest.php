<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Hint;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Hint;
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
        $hint = Hint::widget([new TestForm(), 'string']);

        $this->assertNotSame($hint, $hint->attributes([]));
        $this->assertNotSame($hint, $hint->closure(fn () => ''));
        $this->assertNotSame($hint, $hint->content(''));
        $this->assertNotSame($hint, $hint->tag('div'));
    }
}
