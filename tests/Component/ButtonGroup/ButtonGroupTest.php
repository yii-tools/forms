<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\ButtonGroup;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\ButtonGroup;
use Yii\Forms\Component\Input\Button;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class ButtonGroupTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test.class">
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([['label' => 'Submit', 'type' => 'Submit'], ['label' => 'Reset', 'type' => 'Reset']])
                ->containerAttributes(['class' => 'test.class'])
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testContainerClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="test.class">
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            </div>
            HTML,
            ButtonGroup::widget()
                ->buttons([['label' => 'Submit', 'type' => 'Submit'], ['label' => 'Reset', 'type' => 'Reset']])
                ->containerClass('test.class')
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
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
                    ['attributes' => ['disabled' => true], 'label' => 'Submit', 'type' => 'Submit'],
                    ['attributes' => ['disabled' => true], 'label' => 'Reset', 'type' => 'Reset'],
                ])
                ->individualButtonAttributes(['0' => ['class' => 'btn btn-lg'], '1' => ['class' => 'btn btn-md']])
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
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
                ->buttons([['label' => 'Submit', 'type' => 'Submit'], ['label' => 'Reset', 'type' => 'Reset']])
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
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

    /**
     * @throws ReflectionException
     */
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
                        ['label' => 'Submit', 'type' => 'Submit', 'visible' => false],
                        ['label' => 'Reset', 'type' => 'Reset'],
                    ]
                )
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testWithoutContainer(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input type="Submit" value="Submit">
            <input type="Reset" value="Reset">
            HTML,
            ButtonGroup::widget()
                ->buttons([['label' => 'Submit', 'type' => 'Submit'], ['label' => 'Reset', 'type' => 'Reset']])
                ->container(false)
                ->render(),
        );
    }
}
