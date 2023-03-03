<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\File;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\File;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class GlobalAttributesTest extends TestCase
{
    public function testName(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="name[]" type="file">',
            File::widget([new TestForm(), 'string'])->name('name')->render()
        );
    }
}
