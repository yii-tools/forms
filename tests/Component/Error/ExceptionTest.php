<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Error;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Error;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        Error::widget([new TestForm(), '']);
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testTag(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Tag name cannot be empty.');

        Error::widget([new TestForm(), 'string'])->tag('');
    }
}
