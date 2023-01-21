<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Hidden;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class HiddenTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string]" type="hidden">',
            Hidden::widget([new TestForm(), 'string'])->render(),
        );
    }
}
