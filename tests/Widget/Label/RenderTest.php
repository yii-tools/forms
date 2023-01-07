<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Widget\Label;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Label;

final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testContent(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam &amp; Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark')->render(),
        );
    }

    /**
     * @throws ReflectionException
     *
     * @link https://github.com/yiisoft/form/issues/85
     */
    public function testContentWithEncodeFalse(): void
    {
        $this->assertSame(
            '<label for="testform-string">Sam & Dark</label>',
            Label::widget([new TestForm(), 'string'])->content('Sam & Dark', false)->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<label for="testform-string">String</label>',
            Label::widget([new TestForm(), 'string'])->render(),
        );
    }
}
