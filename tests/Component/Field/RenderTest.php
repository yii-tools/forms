<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Field;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testAfterField(): void
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
            String hint.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->after('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testBeforeField(): void
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
            String hint.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([new TestForm(), 'string'])->placeholder('Name')])
                ->before('<span class="input-group-text"><i class="bi bi-person-fill"></i></span>')
                ->class('form-control')
                ->containerClass('form-group input-group me-3')
                ->inputContainer(true)
                ->inputContainerClass('form-floating flex-grow-1')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->labelContent('Name')
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
    public function testInvalidClass(): void
    {
        $formModel = new TestForm();
        $formModel->error()->add('string', 'This is a error message');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="testform-string">String</label>
            <input class="form-control is-invalid" id="testform-string" name="TestForm[string]" type="text" placeholder="Name">
            <div>
            String hint.
            </div>
            <div>
            This is a error message
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->invalidClass('is-invalid')
                ->render(),
        );
    }

    /**
     * @throws ReflectionException
     */
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
            String hint.
            </div>
            </div>
            HTML,
            Field::widget([Text::widget([$formModel, 'string'])->placeholder('Name')])
                ->class('form-control')
                ->validClass('is-valid')
                ->render(),
        );
    }
}
