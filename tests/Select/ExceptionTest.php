<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Select;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use stdClass;
use Yii\Forms\Select;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionTest extends TestCase
{
    public function testValue(): void
    {
        $formModel = new TestForm();

        // Value object `stdClass`.
        $formModel->setAttributeValue('object', new stdClass());

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Select::class widget value can not be an object.');

        Select::widget([$formModel, 'object'])->render();
    }
}
