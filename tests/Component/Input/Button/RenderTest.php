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
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testDisabled(): void
    {
        $this->assertSame('<input type="button" disabled>', Button::widget()->disabled()->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testForm(): void
    {
        $this->assertSame('<input type="button" form="form">', Button::widget()->form('form')->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testRender(): void
    {
        $this->assertSame('<input type="button">', Button::widget()->render());
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testType(): void
    {
        $this->assertSame('<input type="submit">', Button::widget()->type('submit')->render());
    }
}
