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
final class GlobalAttibutesTest extends TestCase
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
            <<<HTML
            <form class="class">
            HTML,
            Form::widget()->attributes(['class' => 'class'])->begin(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testClass(): void
    {
        $this->assertSame(
            <<<HTML
            <form class="class">
            HTML,
            Form::widget()->class('class')->begin(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testId(): void
    {
        $this->assertSame(
            <<<HTML
            <form id="test.id">
            HTML,
            Form::widget()->id('test.id')->begin(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testName(): void
    {
        $this->assertSame(
            <<<HTML
            <form name="test.name">
            HTML,
            Form::widget()->name('test.name')->begin(),
        );
    }
}
