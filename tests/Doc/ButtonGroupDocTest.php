<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Input\Button;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ButtonGroupDocTest extends TestCase
{
    public function testButtons(): void
    {
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
    }

    public function testButtonsWithButtonWidget(): void
    {
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

    public function testIndividualAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="btn btn-lg" type="Submit" value="Submit" disabled>
            <input class="btn btn-md" type="Reset" value="Reset" disabled>
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    [
                        ['attributes' => ['disabled' => true], 'type' => 'Submit', 'value' => 'Submit'],
                        ['attributes' => ['disabled' => true], 'type' => 'Reset', 'value' => 'Reset'],
                    ]
                )
                ->individualButtonAttributes(['0' => ['class' => 'btn btn-lg'], '1' => ['class' => 'btn btn-md']])
                ->render(),
        );
    }

    public function testField(): void
    {
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
                        ->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']]),
                ]
            )->render()
        );
    }

    public function testFieldWithButtonWidget(): void
    {
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
                        ->buttons([Button::widget()->type('submit'), Button::widget()->type('reset')]),
                ]
            )->render()
        );
    }
}
