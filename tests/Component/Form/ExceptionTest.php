<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Form;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Form;
use Yii\Forms\Tests\Support\TestTrait;

final class ExceptionTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testEnctype(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The formenctype attribute must be one of the following values: ' .
            '"multipart/form-data", "application/x-www-form-urlencoded", "text/plain"'
        );

        Form::widget()->enctype('')->begin();
    }

    /**
     * @throws ReflectionException
     */
    public function testTarget(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            'The formtarget attribute value must be one of "_blank", "_self", "_parent" or "_top"'
        );

        Form::widget()->target('')->begin();
    }
}
