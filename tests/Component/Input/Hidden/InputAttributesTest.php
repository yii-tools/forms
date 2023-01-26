<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Hidden;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class InputAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAriaDescribedBy(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" aria-describedby="test">',
            Hidden::widget([new TestForm(), 'string'])->ariaDescribedBy('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAriaLabel(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" aria-label="test">',
            Hidden::widget([new TestForm(), 'string'])->ariaLabel('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testDisabled(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" disabled>',
            Hidden::widget([new TestForm(), 'string'])->disabled()->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testForm(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" form="test">',
            Hidden::widget([new TestForm(), 'string'])->form('test')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>Prefix</span>
            <input id="testform-string" name="TestForm[string]" type="hidden">
            HTML,
            Hidden::widget([new TestForm(), 'string'])->prefix('<span>Prefix</span>')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testPrefixAndSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>Prefix</span>
            <input id="testform-string" name="TestForm[string]" type="hidden">
            <span>Suffix</span>
            HTML,
            Hidden::widget([new TestForm(), 'string'])
                ->prefix('<span>Prefix</span>')
                ->suffix('<span>Suffix</span>')
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testReadonly(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" readonly>',
            Hidden::widget([new TestForm(), 'string'])->readonly()->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testRequired(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden" required>',
            Hidden::widget([new TestForm(), 'string'])->required()->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="hidden">
            <span>Suffix</span>
            HTML,
            Hidden::widget([new TestForm(), 'string'])->suffix('<span>Suffix</span>')->render(),
        );
    }
}
