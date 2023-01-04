<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Base;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Stringable;
use Yii\Forms\Base\AbstractFormWidget;
use Yii\Forms\Exception\AttributeNotSet;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Model\AbstractFormModel;

final class ExceptionWidgetTest extends TestCase
{
    /**
     * @throws ReflectionException
     */
    public function testGetAttributeNotSet(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');

        $widget = $this->widget(new PropertyTypeForm(), '');
    }

    /**
     * @throws ReflectionException
     */
    public function testGetAttributeNotExist(): void
    {
        $this->expectException(AttributeNotSet::class);
        $this->expectExceptionMessage('Failed to create widget because "attribute" is not set or not exists.');
        $widget = $this->widget(new PropertyTypeForm(), 'noExist');
    }

    private function widget(AbstractFormModel $formModel, string $fieldAttributes): AbstractFormWidget
    {
        return new class ($formModel, $fieldAttributes) extends AbstractFormWidget {
            public function render(): string|Stringable
            {
                return '';
            }
        };
    }
}
