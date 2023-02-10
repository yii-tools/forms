<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Select;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Yii\Forms\Component\Select;
use Yii\Forms\Tests\Support\TestForm;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testValue(): void
    {
        $formModel = new TestForm();

        // Value object `stdClass`.
        $formModel->setValue('object', new stdClass());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Select::class widget value can not be an object.');

        Select::widget([$formModel, 'object'])->render();
    }
}
