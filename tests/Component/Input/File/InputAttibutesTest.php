<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\File;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\File;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class InputAttibutesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testAccept(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string][]" type="file" accept="image/png, image/jpeg">',
            File::widget([new TestForm(), 'string'])->accept('image/png, image/jpeg')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMultiple(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string][]" type="file" multiple>',
            File::widget([new TestForm(), 'string'])->multiple()->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testName(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="test.name[]" type="file">',
            File::widget([new TestForm(), 'string'])->name('test.name')->render(),
        );
    }
}
