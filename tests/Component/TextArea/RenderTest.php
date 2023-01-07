<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testCols(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" cols="20"></textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->cols(20)->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testContent(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" cols="20">test.content</textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->cols(20)->content('test.content')->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRows(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" rows="2"></textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->rows(2)->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testWrap(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" wrap="hard"></textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->wrap()->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testWrapWithSoft(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="testform-string" name="TestForm[string]" wrap="soft"></textarea>
            HTML,
            TextArea::widget([new TestForm(), 'string'])->wrap('soft')->render()
        );
    }

    /**
     * @throws ReflectionException
     */
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
