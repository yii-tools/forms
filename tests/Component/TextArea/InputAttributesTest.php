<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;

final class InputAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testAriaLabel(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" aria-label="test.areaLabel"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->ariaLabel('test.areaLabel')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testDirname(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" dirname="test.dir"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->dirname('test.dir')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testDisabled(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" disabled></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->disabled()->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testForm(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" form="test.form"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->form('test.form')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMaxLength(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" maxlength="10"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->maxlength(10)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMinLength(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" minlength="4"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->minlength(4)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testPlaceholder(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" placeholder="test.placeholder"></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->placeholder('test.placeholder')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testReadonly(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" readonly></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->readonly()->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRequired(): void
    {
        $this->assertSame(
            <<<HTML
            <textarea id="propertytypeform-string" name="PropertyTypeForm[string]" required></textarea>
            HTML,
            TextArea::widget([new PropertyTypeForm(), 'string'])->required()->render(),
        );
    }
}
