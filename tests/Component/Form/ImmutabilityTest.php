<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Form;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Form;
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
    public function testImmutability(): void
    {
        $form = Form::widget();

        $this->assertNotSame($form, $form->acceptCharset(''));
        $this->assertNotSame($form, $form->attributes([]));
        $this->assertNotSame($form, $form->autocomplete('on'));
        $this->assertNotSame($form, $form->action(''));
        $this->assertNotSame($form, $form->csrf(''));
        $this->assertNotSame($form, $form->enctype('text/plain'));
        $this->assertNotSame($form, $form->method(''));
        $this->assertNotSame($form, $form->noValidate());
        $this->assertNotSame($form, $form->target('_blank'));
    }
}
