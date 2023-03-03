<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ButtonDocTest extends TestCase
{
    public function testButton(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="button">
            HTML,
            Button::widget()->render(),
        );

        // submit.
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="submit">
            HTML,
            Button::widget()->type('submit')->render(),
        );

        // value.
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="button" value="Click me">
            HTML,
            Button::widget()->value('Click me')->render(),
        );
    }

    public function testFieldButton(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input type="button">
            </div>
            HTML,
            Field::widget([Button::widget()])->render(),
        );
    }
}
