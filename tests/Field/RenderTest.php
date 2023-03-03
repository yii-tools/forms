<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Field;

use PHPUnit\Framework\TestCase;
use Stringable;
use Yii\FormModel\FormModelInterface;
use Yii\Forms\ButtonGroup;
use Yii\Forms\Field;
use Yii\Forms\Input\Hidden;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\BasicForm;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testAriaDescribedByWithTrue(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name" aria-describedby="testform-string-help">
            <label for="testform-string">Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div id="testform-string-help">
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->ariaDescribedBy(true)
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->suffix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testAriaDescribedByWithString(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name" aria-describedby="testform-string-help">
            <label for="testform-string">Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div id="testform-string-help">
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->ariaDescribedBy('testform-string-help')
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->suffix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div data-test="test">
            <label for="testform-string">String</label>
            <input id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->containerAttributes(['data-test' => 'test'])
                ->render(),
        );
    }

    public function testErrorAttributes(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <div class="invalid-feedback">
            This is a error content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->errorAttributes(['class' => 'invalid-feedback'])
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testErrorClass(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <div class="is-invalid">
            This is a error content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->errorClass('is-invalid')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testErrorClosure(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <div class="invalid-feedback">
            This closure error content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->errorClosure(
                    static function (FormModelInterface $formModel): string {
                        return '<div class="invalid-feedback">' . "\n" . 'This closure error content' . "\n" . '</div>';
                    },
                )
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testErrorContent(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <div class="is-invalid">
            This is custom error content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->errorClass('is-invalid')
                ->errorContent('This is custom error content')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testErrorTag(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <span class="is-invalid">This is a error content</span>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->errorClass('is-invalid')
                ->errorTag('span')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testHintAttributes(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div class="form-text text-muted">
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->hintAttributes(['class' => 'form-text text-muted'])
                ->render(),
        );
    }

    public function testHintClass(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div class="form-text text-muted">
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->hintClass('form-text text-muted')
                ->render(),
        );
    }

    public function testHintClosure(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div class="form-text text-muted">
            This custom closure content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->hintClosure(
                    static function (FormModelInterface $formModel): string {
                        return
                            '<div class="form-text text-muted">' . "\n" .
                            'This custom closure content' . "\n" .
                            '</div>';
                    }
                )
                ->render(),
        );
    }

    public function testHintContent(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            The custom hint content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->hintContent('The custom hint content')
                ->render(),
        );
    }

    public function testHintTag(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <span>String hint</span>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->hintTag('span')
                ->render(),
        );
    }

    public function testInputContainerAttributes(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <label for="testform-string">Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerAttributes(['class' => 'form-floating flex-grow-1'])
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->suffix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testInvalidClass(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            <div>
            This is a error content
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testInvalidClassWithFormEmptyData(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    public function testLabelAttributes(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="form-text" for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->labelAttributes(['class' => 'form-text'])
                ->render(),
        );
    }

    public function testLabelClass(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="form-text" for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->labelClass('form-text')
                ->render(),
        );
    }

    public function testLabelClosure(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label class="form-text" for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->labelClosure(
                    static function (FormModelInterface $formModel): string {
                        return '<label class="form-text" for="testform-string">String</label>';
                    },
                )
                ->render(),
        );
    }

    public function testNotLabel(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->notLabel()
                ->render(),
        );
    }

    public function testPrefixField(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <label for="testform-string">Name</label>
            </div>
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->prefix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testPrefixFieldWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <label for="testform-string">Name</label>
            </div>
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->prefix(
                    new class () implements Stringable {
                        public function __toString(): string
                        {
                            return '<span class="input-group-text"><i class="bi bi-person-fill"></i></span>';
                        }
                    }
                )
                ->render(),
        );
    }

    public function testPrefixInputWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input class="form-control" id="basicform-username" name="BasicForm[username]" type="text" aria-describedby="basic-addon1" aria-label="Username" placeholder="Username">
            </div>
            HTML,
            Field::widget([
                Text::widget([new BasicForm(), 'username'])
                    ->ariaDescribedBy('basic-addon1')
                    ->ariaLabel('Username')
                    ->placeHolder('Username')
                    ->prefix(
                        new class () implements Stringable {
                            public function __toString(): string
                            {
                                return '<span class="input-group-text" id="basic-addon1">@</span>';
                            }
                        }
                    ),
            ])
                ->class('form-control')
                ->containerClass('input-group mb-3')
                ->notLabel()
                ->render(),
        );
    }

    public function testSuffixField(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <label for="testform-string">Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->suffix('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testSuffixFieldWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="form-group input-group me-3">
            <div class="form-floating flex-grow-1">
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <label for="testform-string">Name</label>
            </div>
            <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->suffix(new class () implements Stringable {
                    public function __toString(): string
                    {
                        return '<span class="input-group-text"><i class="bi bi-person-fill"></i></span>';
                    }
                })
                ->template('{field}' . PHP_EOL . '{suffix}' . PHP_EOL . '{hint}')
                ->render(),
        );
    }

    public function testSuffixInputWithStringable(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group mb-3">
            <input class="form-control" id="basicform-email" name="BasicForm[email]" type="text" aria-describedby="basic-addon2" aria-label="Recipient&apos;s username" placeholder="Recipient&apos;s username">
            <span class="input-group-text" id="basic-addon2">@example.com</span>
            </div>
            HTML,
            Field::widget([
                Text::widget([new BasicForm(), 'email'])
                    ->ariaDescribedBy('basic-addon2')
                    ->ariaLabel("Recipient's username")
                    ->placeHolder("Recipient's username")
                    ->suffix(
                        new class () implements Stringable {
                            public function __toString(): string
                            {
                                return '<span class="input-group-text" id="basic-addon2">@example.com</span>';
                            }
                        }
                    ),
            ])
                ->class('form-control')
                ->containerClass('input-group mb-3')
                ->notLabel()
                ->render(),
        );
    }

    public function testValidClass(): void
    {
        $formModel = new TestForm();
        $formModel->load(['TestForm' => ['string' => 'test.name']]);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-valid" id="testform-string" name="TestForm[string]" type="text" value="test.name" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->validClass('is-valid')
                ->render(),
        );
    }

    public function testValidClassWithFormEmptyData(): void
    {
        $formModel = new TestForm();

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->validClass('is-valid')
                ->render(),
        );
    }

    public function testWidgetButtonGroup(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

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
                ],
            )
                ->class('form-control')
                ->render(),
        );
    }

    public function testWidgetHidden(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="form-control" id="testform-mąka" name="TestForm[mĄkA]" type="hidden">
            </div>
            HTML,
            Field::widget([Hidden::widget([$formModel, 'mĄkA'])])
                ->class('form-control')
                ->render(),
        );
    }
}
