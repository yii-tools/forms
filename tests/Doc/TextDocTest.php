<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class TextDocTest extends TestCase
{
    public function testField(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])])->render(),
        );
    }

    public function testFieldWithPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <span><i class="bi bi-person-fill"></i></span>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])
                ->prefix('<span><i class="bi bi-person-fill"></i></span>'), ])
                ->render(),
        );
    }

    public function testFieldWithSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-name">Name</label>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <span><i class="bi bi-person-fill"></i></span>
            </div>
            HTML,
            Field::widget([Text::widget([new ContactForm(), 'name'])
                ->suffix('<span><i class="bi bi-person-fill"></i></span>'), ])
                ->render(),
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span><i class="bi bi-person-fill"></i></span>
            <input id="contactform-name" name="ContactForm[name]" type="text">
            HTML,
            Text::widget([new ContactForm(), 'name'])
                ->prefix('<span><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-name" name="ContactForm[name]" type="text">
            HTML,
            Text::widget([new ContactForm(), 'name'])->render(),
        );

        // suffix.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <span><i class="bi bi-person-fill"></i></span>
            HTML,
            Text::widget([new ContactForm(), 'name'])
                ->suffix('<span><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-name" name="ContactForm[name]" type="text">
            <span><i class="bi bi-person-fill"></i></span>
            HTML,
            Text::widget([new ContactForm(), 'name'])
                ->suffix('<span><i class="bi bi-person-fill"></i></span>')
                ->render(),
        );
    }
}
