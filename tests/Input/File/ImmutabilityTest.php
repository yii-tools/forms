<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\File;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\File;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $file = File::widget([new TestForm(), 'string']);

        $this->assertNotSame($file, $file->unchecked(''));
    }
}
