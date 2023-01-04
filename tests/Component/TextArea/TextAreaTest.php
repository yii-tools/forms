<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;

final class TextAreaTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testCols(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]" cols="20"></textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->cols(20)->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testContent(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]" cols="20">test.content</textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->cols(20)->content('test.content')->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRows(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]" rows="2"></textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->rows(2)->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testWrap(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]" wrap="hard"></textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->wrap()->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testWrapWithSoft(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]" wrap="soft"></textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->wrap('soft')->render()
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<textarea id="propertytypeform-string" name="PropertyTypeForm[string]"></textarea>',
            TextArea::widget([new PropertyTypeForm(), 'string'])->render(),
        );
    }
}
