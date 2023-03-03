<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Form;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Form;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ImmutabilityTest extends TestCase
{
    public function testImmutability(): void
    {
        $form = Form::widget();

        $this->assertNotSame($form, $form->acceptCharset(''));
        $this->assertNotSame($form, $form->action(''));
        $this->assertNotSame($form, $form->csrf(''));
        $this->assertNotSame($form, $form->enctype('text/plain'));
        $this->assertNotSame($form, $form->method(''));
        $this->assertNotSame($form, $form->noValidate());
        $this->assertNotSame($form, $form->target('_blank'));
    }
}
