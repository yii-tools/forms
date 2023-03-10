<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\TextArea;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class TextAreaDocTest extends TestCase
{
    public function testAutocomplete(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" autocomplete="on"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->autocomplete('on')->render(),
        );
    }

    public function testCols(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" cols="10"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->Cols(10)->render(),
        );
    }

    public function testDirname(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" dirname="comment.dir"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->dirname('comment.dir')->render(),
        );
    }

    public function testField(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-message">Message</label>
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            </div>
            HTML,
            Field::widget([TextArea::widget([new ContactForm(), 'message'])])->render(),
        );
    }

    public function testFieldWithPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <span>Enter your message</span>
            <label for="contactform-message">Message</label>
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            </div>
            HTML,
            Field::widget([TextArea::widget([new ContactForm(), 'message'])])
                ->prefix('<span>Enter your message</span>')
                ->render(),
        );
    }

    public function testFieldWithSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-message">Message</label>
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            <span>Enter your message</span>
            </div>
            HTML,
            Field::widget([TextArea::widget([new ContactForm(), 'message'])])
                ->suffix('<span>Enter your message</span>')
                ->render(),
        );
    }

    public function testMaxLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" maxlength="100"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->maxLength(100)->render(),
        );
    }

    public function testMinLength(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" minlength="10"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->minLength(10)->render(),
        );
    }

    public function testPlaceholder(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" placeholder="Enter your message"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->placeholder('Enter your message')->render(),
        );
    }

    public function testPrefix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <span>Enter your message</span>
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->prefix('<span>Enter your message</span>')->render(),
        );
    }

    public function testRender(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->render(),
        );
    }

    public function testRows(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" rows="10"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->rows(10)->render(),
        );
    }

    public function testSuffix(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]"></textarea>
            <span>Enter your message</span>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->suffix('<span>Enter your message</span>')->render(),
        );
    }

    public function testWrap(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <textarea id="contactform-message" name="ContactForm[message]" wrap="hard"></textarea>
            HTML,
            TextArea::widget([new ContactForm(), 'message'])->wrap('hard')->render(),
        );
    }
}
