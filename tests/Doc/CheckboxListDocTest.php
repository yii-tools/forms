<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CheckboxListDocTest extends TestCase
{
    use TestTrait;

    private array $items = ['1' => 'Technical', '2' => 'Sales', '3' => 'Other'];

    public function testCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="contactform-reason">
            <label><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            HTML,
            CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="contactform-reason">
            <label><span><i class="bi bi-align-top"></i></span><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><span><i class="bi bi-check"></i></span><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><span><i class="bi bi-app"></i></i></span><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            HTML,
            CheckboxList::widget([new ContactForm(), 'reason'])
                ->items($this->items)
                ->individualPrefix(
                    [
                        '1' => '<span><i class="bi bi-align-top"></i></span>',
                        '2' => '<span><i class="bi bi-check"></i></span>',
                        '3' => '<span><i class="bi bi-app"></i></i></span>'
                    ],
                )
                ->render(),
        );

        // suffix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div id="contactform-reason">
            <label><input name="ContactForm[reason][]" type="checkbox" value="1"><span><i class="bi bi-align-top"></i></span>Technical</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="2"><span><i class="bi bi-check"></i></span>Sales</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="3"><span><i class="bi bi-app"></i></i></span>Other</label>
            </div>
            HTML,
            CheckboxList::widget([new ContactForm(), 'reason'])
                ->items($this->items)
                ->individualSuffix(
                    [
                        '1' => '<span><i class="bi bi-align-top"></i></span>',
                        '2' => '<span><i class="bi bi-check"></i></span>',
                        '3' => '<span><i class="bi bi-app"></i></i></span>'
                    ],
                )
                ->render(),
        );

        // container tag
        Assert::equalsWithoutLE(
            <<<HTML
            <article id="contactform-reason">
            <label><input name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </article>
            HTML,
            CheckboxList::widget([new ContactForm(), 'reason'])
                ->containerTag('article')
                ->items($this->items)
                ->render(),
        );
    }

    public function testFieldCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-reason">Reason</label>
            <div id="contactform-reason">
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            </div>
            HTML,
            Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
                ->class('button is-block is-info is-fullwidth')
                ->render(),
        );

        // change label position.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="contactform-reason">
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            <label for="contactform-reason">I agree</label>
            </div>
            HTML,
            Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
                ->class('button is-block is-info is-fullwidth')
                ->labelContent('I agree')
                ->inputTemplate('{input}' . PHP_EOL . '{label}')
                ->render(),
        );

        // any label.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <div id="contactform-reason">
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            </div>
            HTML,
            Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
                ->class('button is-block is-info is-fullwidth')
                ->notLabel()
                ->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span><i class="bi bi-check"></i></span>
            <label for="contactform-reason">Reason</label>
            <div id="contactform-reason">
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            </div>
            HTML,
            Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
                ->class('button is-block is-info is-fullwidth')
                ->prefix('<span><i class="bi bi-check"></i></span>')
                ->render(),
        );

        // suffix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-reason">Reason</label>
            <div id="contactform-reason">
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="1">Technical</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="2">Sales</label>
            <label><input class="button is-block is-info is-fullwidth" name="ContactForm[reason][]" type="checkbox" value="3">Other</label>
            </div>
            <span><i class="bi bi-check"></i></span>
            </div>
            HTML,
            Field::widget([CheckboxList::widget([new ContactForm(), 'reason'])->items($this->items)])
                ->class('button is-block is-info is-fullwidth')
                ->suffix('<span><i class="bi bi-check"></i></span>')
                ->render(),
        );
    }
}
