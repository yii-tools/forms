<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Input\File;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\File;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class GlobalAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testName(): void
    {
        $this->assertSame(
            '<input id="testform-string" name="name[]" type="file">',
            File::widget([new TestForm(), 'string'])->name('name')->render()
        );
    }
}
