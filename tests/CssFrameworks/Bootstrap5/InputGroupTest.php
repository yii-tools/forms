<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\CssFrameworks\Bootstrap5;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Field;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\BasicForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class InputGroupTest extends TestCase
{
    use TestTrait;

    /**
     * Place one add-on or button on either side of an input. You may also place one on both sides of an input. Remember
     * to place <label>s outside the input group.
     *
     * @link https://getbootstrap.com/docs/5.2/forms/input-group/#basic-example
     *
     * @throws ReflectionException
     */
    public function testBasicExample(): void
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
                    ->placeHolder('Username'),
            ])
                ->beforeInput('<span class="input-group-text" id="basic-addon1">@</span>')
                ->class('form-control')
                ->containerClass('input-group mb-3')
                ->inputTemplate('{beforeInput}' . PHP_EOL . '{input}')
                ->render(),
        );

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
                    ->placeHolder("Recipient's username"),
            ])
                ->afterInput('<span class="input-group-text" id="basic-addon2">@example.com</span>')
                ->class('form-control')
                ->containerClass('input-group mb-3')
                ->inputTemplate('{input}' . PHP_EOL . '{afterInput}')
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <label class="form-label" for="basic-url">Your vanity URL</label>
            <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
            <input class="form-control" id="basic-url" name="BasicForm[url]" type="text" aria-describedby="basic-addon3">
            </div>
            HTML,
            Field::widget([
                Text::widget([new BasicForm(), 'url'])->ariaDescribedBy('basic-addon3')->id('basic-url'),
            ])
                ->beforeInput('<span class="input-group-text" id="basic-addon3">https://example.com/users/</span>')
                ->class('form-control')
                ->container(false)
                ->inputContainer(true)
                ->inputContainerClass('input-group mb-3')
                ->inputTemplate('{beforeInput}' . PHP_EOL . '{input}')
                ->labelClass('form-label')
                ->labelContent('Your vanity URL')
                ->template('{label}' . PHP_EOL . '{field}')
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group mb-3">
            <span class="input-group-text">$</span>
            <input class="form-control" id="basicform-amount" name="BasicForm[amount]" type="text" aria-label="Amount (to the nearest dollar)">
            <span class="input-group-text">.00</span>
            </div>
            HTML,
            Field::widget([
                Text::widget([new BasicForm(), 'amount'])->ariaLabel('Amount (to the nearest dollar)'),
            ])
                ->afterInput('<span class="input-group-text">.00</span>')
                ->beforeInput('<span class="input-group-text">$</span>')
                ->class('form-control')
                ->container(false)
                ->inputContainer(true)
                ->inputContainerClass('input-group mb-3')
                ->inputTemplate('{beforeInput}' . PHP_EOL . '{input}' . PHP_EOL . '{afterInput}')
                ->notLabel()
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group mb-3">
            <input class="form-control" id="basicform-username" name="BasicForm[username]" type="text" aria-label="Username" placeholder="Username">
            <span class="input-group-text">@</span>
            <input class="form-control" id="basicform-server" name="BasicForm[server]" type="text" aria-label="Server" placeholder="Server">
            </div>
            HTML,
            Field::widget([
                Text::widget([new BasicForm(), 'server'])
                    ->ariaLabel('Server')
                    ->class('form-control')
                    ->placeHolder('Server'),
            ])
                ->afterInput('<span class="input-group-text">@</span>')
                ->beforeInput(
                    Text::widget([new BasicForm(), 'username'])
                        ->ariaLabel('Username')
                        ->class('form-control')
                        ->placeHolder('Username')
                )
                ->container(false)
                ->inputContainer(true)
                ->inputContainerClass('input-group mb-3')
                ->inputTemplate('{beforeInput}' . PHP_EOL . '{afterInput}' . PHP_EOL . '{input}')
                ->notLabel()
                ->render(),
        );

        Assert::equalsWithoutLE(
            <<<HTML
            <div class="input-group">
            <span class="input-group-text">With textarea</span>
            <textarea class="form-control" id="basicform-textarea" name="BasicForm[textArea]" aria-label="With textarea"></textarea>
            </div>
            HTML,
            Field::widget([
                TextArea::widget([new BasicForm(), 'textArea'])
                    ->ariaLabel('With textarea')
                    ->class('form-control'),
            ])
                ->beforeInput('<span class="input-group-text">With textarea</span>')
                ->container(false)
                ->inputContainer(true)
                ->inputContainerClass('input-group')
                ->inputTemplate('{beforeInput}' . PHP_EOL . '{input}')
                ->notLabel()
                ->render(),
        );
    }
}
