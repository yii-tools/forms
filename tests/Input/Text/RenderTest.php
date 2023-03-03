<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\Text;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\PlaceholderForm;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testPlaceholder(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="placeholderform-text" name="PlaceholderForm[text]" type="text" placeholder="Enter your text">
            HTML,
            Text::widget([new PlaceholderForm(), 'text'])->render(),
        );
    }

    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text">',
            Text::widget([new TestForm(), 'string'])->render(),
        );
    }

    public function testValue(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" value="value">',
            Text::widget([new TestForm(), 'string'])->value('value')->render()
        );
    }
}
