<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\TextArea;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\PlaceholderForm;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\TextArea;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testContent(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" cols="20">test.content</textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->cols(20)->content('test.content')->render()
        );
    }

    public function testPlaceholder(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="placeholderform-text" name="PlaceholderForm[text]" placeholder="Enter your text"></textarea>
            HTML,
            TextArea::widget([new PlaceholderForm(), 'text'])->render(),
        );
    }

    public function testRender(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]"></textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->render(),
        );
    }
}
