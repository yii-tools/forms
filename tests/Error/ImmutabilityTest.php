<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Error;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Error;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $error = Error::widget([new TestForm(), 'string']);

        $this->assertNotSame($error, $error->closure(static fn () => ''));
        $this->assertNotSame($error, $error->content(''));
        $this->assertNotSame($error, $error->tag('div'));
    }
}
