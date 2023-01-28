<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Button;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class GlobalAttributesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAttributes(): void
    {
        $this->assertSame(
            '<input id="id" name="name" type="button" value="value">',
            Button::widget()
                ->attributes(['id' => 'id', 'name' => 'name', 'value' => 'value'])
                ->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testAutofocus(): void
    {
        $this->assertSame('<input type="button" autofocus>', Button::widget()->autofocus()->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testClass(): void
    {
        $this->assertSame('<input class="class" type="button">', Button::widget()->class('class')->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testId(): void
    {
        $this->assertSame('<input id="id" type="button">', Button::widget()->id('id')->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testName(): void
    {
        $this->assertSame('<input name="name" type="button">', Button::widget()->name('name')->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testTabindex(): void
    {
        $this->assertSame('<input type="button" tabindex="1">', Button::widget()->tabindex(1)->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testTitle(): void
    {
        $this->assertSame('<input type="button" title="title">', Button::widget()->title('title')->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testValue(): void
    {
        $this->assertSame('<input type="button" value="submit">', Button::widget()->value('submit')->render());
    }
}
