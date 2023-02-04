<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Base;

use PHPUnit\Framework\TestCase;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\Component\Input\AbstractFormInputWidget;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ExceptionWidgetTest extends TestCase
{
    public function testGetAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        $this->widget(new TestForm(), '');
    }

    public function testGetAttributeNotExist(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        $this->widget(new TestForm(), 'noExist');
    }

    private function widget(FormModelInterface $formModel, string $fieldAttributes): AbstractFormInputWidget
    {
        return new class ($formModel, $fieldAttributes) extends AbstractFormInputWidget {
            public function render(): string
            {
                return '';
            }
        };
    }
}
