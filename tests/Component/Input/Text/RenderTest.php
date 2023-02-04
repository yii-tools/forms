<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\PlaceholderForm;
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
    public function testPlaceholder(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="placeholderform-text" name="PlaceholderForm[text]" type="text" placeholder="Enter your text">
            HTML,
            Text::widget([new PlaceholderForm(), 'text'])->render(),
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
    public function testValue(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="text" value="value">',
            Text::widget([new TestForm(), 'string'])->value('value')->render()
        );
    }
}
