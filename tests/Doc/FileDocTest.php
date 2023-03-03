<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\File;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class FileDocTest extends TestCase
{
    public function testCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            HTML,
            File::widget([new ContactForm(), 'attachment'])->render(),
        );

        // unchecked.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-agree" name="ContactForm[agree]" type="hidden" value="0">
            <input id="contactform-agree" name="ContactForm[agree][]" type="file">
            HTML,
            File::widget([new ContactForm(), 'agree'])->unchecked('0')->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <span><i class="fa fa-file"></i></span>
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            HTML,
            File::widget([new ContactForm(), 'attachment'])
                ->prefix('<span><i class="fa fa-file"></i></span>')
                ->render(),
        );

        // suffix.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            <span><i class="fa fa-file"></i></span>
            HTML,
            File::widget([new ContactForm(), 'attachment'])
                ->suffix('<span><i class="fa fa-file"></i></span>')
                ->render(),
        );
    }

    public function testFieldDate(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-attachment">Attachment</label>
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            </div>
            HTML,
            Field::widget([File::widget([new ContactForm(), 'attachment'])])->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-attachment">Attachment</label>
            <span><i class="fa fa-file"></i></span>
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            </div>
            HTML,
            Field::widget([File::widget([new ContactForm(), 'attachment'])
                ->prefix('<span><i class="fa fa-file"></i></span>'), ])
                ->render(),
        );

        // suffix
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-attachment">Attachment</label>
            <input id="contactform-attachment" name="ContactForm[attachment][]" type="file">
            <span><i class="fa fa-file"></i></span>
            </div>
            HTML,
            Field::widget([File::widget([new ContactForm(), 'attachment'])
                ->suffix('<span><i class="fa fa-file"></i></span>'), ])
                ->render(),
        );
    }
}
