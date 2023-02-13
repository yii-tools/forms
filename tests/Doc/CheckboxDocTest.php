<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Checkbox;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CheckboxDocTest extends TestCase
{
    public function testCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
            HTML,
            Checkbox::widget([new ContactForm(), 'agree'])->render(),
        );

        // prefix
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="contactform-agree"><span><i class="bi bi-check"></i></span><input id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
            HTML,
            Checkbox::widget([new ContactForm(), 'agree'])
                ->prefix('<span><i class="bi bi-check"></i></span>')
                ->render(),
        );

        // suffix
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="contactform-agree"><input id="contactform-agree" name="ContactForm[agree]" type="checkbox"><span><i class="bi bi-check"></i></span>Agree</label>
            HTML,
            Checkbox::widget([new ContactForm(), 'agree'])
                ->suffix('<span><i class="bi bi-check"></i></span>')
                ->render(),
        );

        // container.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-agree">Agree</label>
            <input id="contactform-agree" name="ContactForm[agree]" type="checkbox">
            </div>
            HTML,
            Checkbox::widget([new ContactForm(), 'agree'])->container(true)->render(),
        );
    }

    public function testFieldCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-agree">Agree</label>
            <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
            </div>
            HTML,
            Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
                ->class('button is-block is-info is-fullwidth')
                ->render(),
        );

        // change label position.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
            <label for="contactform-agree">I agree</label>
            </div>
            HTML,
            Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
                ->class('button is-block is-info is-fullwidth')
                ->labelContent('I agree')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->render(),
        );

        // enclosed by label for the widget.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-agree"><input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">Agree</label>
            </div>
            HTML,
            Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
                ->class('button is-block is-info is-fullwidth')
                ->inputTemplate('{input}')
                ->render(),
        );

        // any label.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input class="button is-block is-info is-fullwidth" id="contactform-agree" name="ContactForm[agree]" type="checkbox">
            </div>
            HTML,
            Field::widget([Checkbox::widget([new ContactForm(), 'agree'])])
                ->class('button is-block is-info is-fullwidth')
                ->notLabel()
                ->render(),
        );
    }
}
