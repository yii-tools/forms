<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\File;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\File;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class FileTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="hidden" value="0">
            <input id="testform-string" name="TestForm[string][]" type="file">
            HTML,
            File::widget([new TestForm(), 'string'])->hidden('0')->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="TestForm[string][]" type="file">',
            File::widget([new TestForm(), 'string'])->render(),
        );
    }
}
