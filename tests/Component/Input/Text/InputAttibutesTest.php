<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class InputAttibutesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testDirname(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" dirname="test.dir">
            HTML,
            Text::widget([new TestForm(), 'string'])->dirname('test.dir')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMaxLength(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" maxlength="10">
            HTML,
            Text::widget([new TestForm(), 'string'])->maxlength(10)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testMinLength(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" minlength="4">
            HTML,
            Text::widget([new TestForm(), 'string'])->minlength(4)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testPattern(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" title="Only accepts uppercase and lowercase letters." pattern="[A-Za-z]">
            HTML,
            Text::widget([new TestForm(), 'string'])
                ->pattern('[A-Za-z]')
                ->title('Only accepts uppercase and lowercase letters.')
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testPlaceholder(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" placeholder="test.placeholder">
            HTML,
            Text::widget([new TestForm(), 'string'])->placeholder('test.placeholder')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testSize(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" size="10">
            HTML,
            Text::widget([new TestForm(), 'string'])->size(10)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testValue(): void
    {
        // Value string `test.string`.
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" value="test.string">
            HTML,
            Text::widget([new TestForm(), 'string'])->value('test.string')->render(),
        );

        // Value `null`.
        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text">
            HTML,
            Text::widget([new TestForm(), 'string'])->value(null)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testValueWithFormModel(): void
    {
        $formModel = new TestForm();

        // Value string `test.string`.
        $formModel->setValue('string', 'test.string');

        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text" value="test.string">
            HTML,
            Text::widget([$formModel, 'string'])->render(),
        );

        // Value `null`.
        $formModel->setValue('string', null);

        $this->assertSame(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="text">
            HTML,
            Text::widget([$formModel, 'string'])->render(),
        );
    }
}
