<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Form;
use Yii\Forms\Tests\Support\TestTrait;

final class GlobalAttibutesTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
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
     * @throws ReflectionException
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
     * @throws ReflectionException
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
     * @throws ReflectionException
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
