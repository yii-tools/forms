<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\File;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\File;
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
        $file = File::widget([new TestForm(), 'string']);

        $this->assertNotSame($file, $file->accept('image/png'));
        $this->assertNotSame($file, $file->hidden('', []));
        $this->assertNotSame($file, $file->multiple());
    }
}
