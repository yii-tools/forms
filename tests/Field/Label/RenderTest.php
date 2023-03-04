<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field\Label;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field\Label;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testContent(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam &amp; Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark')->render(),
        );
    }

    public function testContentWithEncodeFalse(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam & Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark')->encode(false)->render(),
        );
    }

    public function testRender(): void
    {
        $this->assertSame(
            '<label for="testform-string">String</label>',
            Label::widget([new TestForm(), 'string'])->render(),
        );
    }
}
