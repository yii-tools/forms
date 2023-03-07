<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class HintDocTest extends TestCase
{
    public function testAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<div data-test="test">
			String hint
			</div>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])
                ->hintAttributes(['data-test' => 'test'])
                ->render(),
        );
    }

    public function testClass(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="text">
            <div class="form-hint">
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])->hintClass('form-hint')->render(),
        );
    }

    public function testClosure(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="text">
            <div>String hint</div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])])
                ->hintClosure(
                    static fn (TestForm $formModel) => '<div>' . $formModel->getHint('string') . '</div>'
                )
                ->render(),
        );
    }

    public function testContent(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <div>
            Enter your name
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->hintContent('Enter your name')->render(),
        );
    }

    public function testTag(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
			<div>
			<label for="testform-string">String</label>
			<input id="testform-string" name="TestForm[string]" type="text">
			<span>String hint</span>
			</div>
			HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])])->hintTag('span')->render(),
        );
    }
}
