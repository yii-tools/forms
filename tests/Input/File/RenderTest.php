<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\File;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\File;
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
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testHidden(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="testform-string" name="TestForm[string]" type="hidden" value="0">
            <input id="testform-string" name="TestForm[string][]" type="file">
            HTML,
            File::widget([new TestForm(), 'string'])->unchecked('0')->render(),
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
            '<input id="testform-string" name="TestForm[string][]" type="file">',
            File::widget([new TestForm(), 'string'])->render(),
        );
    }
}
