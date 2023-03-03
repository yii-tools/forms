<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\ButtonGroup;

use PHPUnit\Framework\TestCase;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Input\Button;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
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

    public function testIndividualButtonAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="btn btn-lg" type="Submit" value="Submit" disabled>
            <input class="btn btn-md" type="Reset" value="Reset" disabled>
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([
                    ['attributes' => ['disabled' => true], 'type' => 'Submit', 'value' => 'Submit'],
                    ['attributes' => ['disabled' => true], 'type' => 'Reset', 'value' => 'Reset'],
                ])
                ->individualButtonAttributes(['0' => ['class' => 'btn btn-lg'], '1' => ['class' => 'btn btn-md']])
                ->render(),
        );
    }

    public function testRender(): void
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

    public function testRenderWithTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input type="submit" value="Send">
            <input type="reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([
                    Button::widget()->type('submit')->value('Send'),
                    Button::widget()->type('reset')->value('Reset'),
                ])
                ->render(),
        );
    }

    public function testVisible(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input type="Reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons(
                    [
                        ['type' => 'Submit', 'value' => 'Submit', 'visible' => false],
                        ['type' => 'Reset', 'value' => 'Reset'],
                    ]
                )
                ->render(),
        );
    }

    public function testWithoutContainer(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            HTML,
            ButtonGroup::widget()
                ->buttons([['type' => 'Submit', 'value' => 'Submit'], ['type' => 'Reset', 'value' => 'Reset']])
                ->container(false)
                ->render(),
        );
    }
}
