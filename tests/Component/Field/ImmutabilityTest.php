<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Field;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testInmutability(): void
    {
        $field = Field::widget([Text::widget([new TestForm(), 'string'])]);

        $this->assertNotSame($field, $field->ariaDescribedBy(false));
        $this->assertNotSame($field, $field->class(''));
        $this->assertNotSame($field, $field->errorAttributes([]));
        $this->assertNotSame($field, $field->errorClass(''));
        $this->assertNotSame($field, $field->errorClosure(fn () => ''));
        $this->assertNotSame($field, $field->errorContent(''));
        $this->assertNotSame($field, $field->errorTag(''));
        $this->assertNotSame($field, $field->hintAttributes([]));
        $this->assertNotSame($field, $field->hintClass(''));
        $this->assertNotSame($field, $field->hintClosure(fn () => ''));
        $this->assertNotSame($field, $field->hintContent(''));
        $this->assertNotSame($field, $field->hintTag(''));
        $this->assertNotSame($field, $field->inputContainer(false));
        $this->assertNotSame($field, $field->inputContainerAttributes());
        $this->assertNotSame($field, $field->inputContainerClass(''));
        $this->assertNotSame($field, $field->inputTemplate(''));
        $this->assertNotSame($field, $field->invalidClass(''));
        $this->assertNotSame($field, $field->labelAttributes([]));
        $this->assertNotSame($field, $field->labelClass(''));
        $this->assertNotSame($field, $field->labelClosure(fn () => ''));
        $this->assertNotSame($field, $field->labelContent(''));
        $this->assertNotSame($field, $field->notLabel());
        $this->assertNotSame($field, $field->template(''));
        $this->assertNotSame($field, $field->validClass(''));
    }
}
