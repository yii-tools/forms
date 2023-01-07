<?php

declare(strict_types=1);

namespace Forge\Form\Tests\Field\Error;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Error;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $error = Error::widget([new TestForm(), 'string']);

        $this->assertNotSame($error, $error->attributes([]));
        $this->assertNotSame($error, $error->callback([new TestForm(), 'customErrorCallback']));
        $this->assertNotSame($error, $error->message(''));
        $this->assertNotSame($error, $error->tag(''));
    }
}
