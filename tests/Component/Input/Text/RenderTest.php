<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testDirname(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" dirname="test">',
            Text::widget([new TestForm(), 'string'])->dirname('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testMaxLength(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" maxlength="10">',
            Text::widget([new TestForm(), 'string'])->maxLength(10)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testMinLength(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" minlength="10">',
            Text::widget([new TestForm(), 'string'])->minLength(10)->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testPattern(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" pattern="test">',
            Text::widget([new TestForm(), 'string'])->pattern('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testPlaceholder(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" placeholder="test">',
            Text::widget([new TestForm(), 'string'])->placeholder('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text">',
            Text::widget([new TestForm(), 'string'])->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testSize(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" size="10">',
            Text::widget([new TestForm(), 'string'])->size(10)->render(),
        );
    }
}
