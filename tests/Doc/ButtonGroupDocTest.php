<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ButtonGroupDocTest extends TestCase
{
    use TestTrait;

    public function testButtonGroup(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']])
                ->render(),
        );

        // using button widget.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input type="submit">
            <input type="reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([Button::widget()->type('submit'), Button::widget()->type('reset')])
                ->render(),
        );
    }

    public function testFieldButtonGroup(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            </div>
            </div>
            HTML,
            Field::widget(
                [
                    ButtonGroup::widget()
                        ->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']])
                ]
            )->render()
        );

        // using button widget.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div>
            <input type="submit">
            <input type="reset">
            </div>
            </div>
            HTML,
            Field::widget(
                [
                    ButtonGroup::widget()
                        ->buttons([Button::widget()->type('submit'), Button::widget()->type('reset')])
                ]
            )->render()
        );
    }
}
