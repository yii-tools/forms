<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Hidden;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden">',
            Hidden::widget([new TestForm(), 'string'])->render(),
        );
    }
}
