<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Base;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\AbstractFormInputWidget;
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
    public function testImmutability(): void
    {
        $formInputWidget = $this->createWidget();

        $this->assertNotSame($formInputWidget, $formInputWidget->ariaDescribedBy(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->ariaLabel(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->disabled());
        $this->assertNotSame($formInputWidget, $formInputWidget->charset(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->form(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->prefix(''));
        $this->assertNotSame($formInputWidget, $formInputWidget->readonly());
        $this->assertNotSame($formInputWidget, $formInputWidget->required());
        $this->assertNotSame($formInputWidget, $formInputWidget->suffix(''));
    }

    private function createWidget(): AbstractFormInputWidget
    {
        return new class (new TestForm(), 'string') extends AbstractFormInputWidget {
            public function render(): string
            {
                return '';
            }
        };
    }
}
