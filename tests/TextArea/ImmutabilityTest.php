<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\TextArea;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\TextArea;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $textArea = TextArea::widget([new TestForm(), 'string']);

        $this->assertNotSame($textArea, $textArea->content(''));
    }
}
