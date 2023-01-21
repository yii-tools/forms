<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Error;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Error;
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
        $error = Error::widget([new TestForm(), 'string']);

        $this->assertNotSame($error, $error->attributes([]));
        $this->assertNotSame($error, $error->closure(static fn () => ''));
        $this->assertNotSame($error, $error->content(''));
        $this->assertNotSame($error, $error->tag('div'));
    }
}
