<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\CheckboxList;
use Yii\Forms\Field;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class CheckboxListDocTest extends TestCase
{
    private array $items = ['1' => 'Technical', '2' => 'Sales', '3' => 'Other'];

    public function testBoolean(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <label for="contactform-termsandservice">Do you like this post?</label>
            <div id="contactform-termsandservice">
            <label><input name="ContactForm[termsAndService][]" type="checkbox" value="0">No</label>
            <label><input name="ContactForm[termsAndService][]" type="checkbox" value="1">Yes</label>
            </div>
            HTML,
            CheckboxList::widget([new ContactForm(), 'termsAndService'])
                ->boolean()
                ->label('Do you like this post?')
                ->render(),
        );
    }

    public function testContainerTag(): void
    {
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

    public function testField(): void
    {
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
    }

    public function testFieldWithChangeLabelPosition(): void
    {
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
    }

    public function testFieldWithPrefix(): void
    {
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
    }

    public function testFieldWithSuffix(): void
    {
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

    public function testFieldWithoutAnyLabel(): void
    {
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
    }

    public function testItems(): void
    {
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
    }

    public function testPrefix(): void
    {
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
                        '3' => '<span><i class="bi bi-app"></i></i></span>',
                    ],
                )
                ->render(),
        );
    }

    public function testSuffix(): void
    {
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
                        '3' => '<span><i class="bi bi-app"></i></i></span>',
                    ],
                )
                ->render(),
        );
    }
}
