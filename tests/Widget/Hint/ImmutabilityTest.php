<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Widget\Hint;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Hint;

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
        $this->assertNotSame($hint, $hint->message(''));
        $this->assertNotSame($hint, $hint->tag(''));
    }
}
