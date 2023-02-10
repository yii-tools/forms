<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Select;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use StdClass;
use Yii\Forms\Component\Select;
use Yii\Forms\Tests\Support\TestForm;

final class ExceptionTest extends TestCase
{
    /**
     * @throws ReflectionException
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
