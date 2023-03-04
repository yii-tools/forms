<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field\Hint;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field\Hint;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $hint = Hint::widget([new TestForm(), 'string']);

        $this->assertNotSame($hint, $hint->closure(fn () => ''));
        $this->assertNotSame($hint, $hint->content(''));
        $this->assertNotSame($hint, $hint->tag('div'));
    }
}
