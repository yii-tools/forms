<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Label;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Label;
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
    public function testContent(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam &amp; Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark')->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     *
     * @link https://github.com/yiisoft/form/issues/85
     */
    public function testContentWithEncodeFalse(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam & Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark')->encode(false)->render(),
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
            '<label for="testform-string">String</label>',
            Label::widget([new TestForm(), 'string'])->render(),
        );
    }
}
