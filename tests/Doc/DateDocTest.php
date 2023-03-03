<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Date;
use Yii\Forms\Tests\Support\ContactForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class DateDocTest extends TestCase
{
    public function testCheckbox(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            HTML,
            Date::widget([new ContactForm(), 'dateofMessage'])->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <span><i class="fa fa-calendar"></i></span>
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            HTML,
            Date::widget([new ContactForm(), 'dateofMessage'])
                ->prefix('<span><i class="fa fa-calendar"></i></span>')
                ->render(),
        );

        // suffix.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            <span><i class="fa fa-calendar"></i></span>
            HTML,
            Date::widget([new ContactForm(), 'dateofMessage'])
                ->suffix('<span><i class="fa fa-calendar"></i></span>')
                ->render(),
        );
    }

    public function testFieldDate(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-dateofmessage">Dateof Message</label>
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            </div>
            HTML,
            Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])])->render(),
        );

        // prefix.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-dateofmessage">Dateof Message</label>
            <span><i class="fa fa-calendar"></i></span>
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            </div>
            HTML,
            Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])
                ->prefix('<span><i class="fa fa-calendar"></i></span>'), ])
                ->render(),
        );

        // suffix
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <label for="contactform-dateofmessage">Dateof Message</label>
            <input id="contactform-dateofmessage" name="ContactForm[dateofMessage]" type="date">
            <span><i class="fa fa-calendar"></i></span>
            </div>
            HTML,
            Field::widget([Date::widget([new ContactForm(), 'dateofMessage'])
                ->suffix('<span><i class="fa fa-calendar"></i></span>'), ])
                ->render(),
        );
    }
}
