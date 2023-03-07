<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Form;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class FormDocTest extends TestCase
{
    public function testAcceptCharset(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form accept-charset="UTF-8">
            </form>
            HTML,
            Form::widget()->acceptCharset('UTF-8')->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testAction(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form action="/form">
            </form>
            HTML,
            Form::widget()->action('/form')->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testCsrfWithMethodPOST(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form method="POST" _csrf="csrf-token">
            <input name="_csrf" type="hidden" value="csrf-token">
            </form>
            HTML,
            Form::widget()->csrf('csrf-token')->method('POST')->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testEnctype(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form enctype="multipart/form-data">
            </form>
            HTML,
            Form::widget()->enctype('multipart/form-data')->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testMethod(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form method="GET">
            </form>
            HTML,
            Form::widget()->method('GET')->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testNovalidate(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form novalidate>
            </form>
            HTML,
            Form::widget()->novalidate()->begin() . PHP_EOL . Form::end(),
        );
    }

    public function testTarget(): void
    {
        Assert::equalsWithoutLE(
            <<<HTML
            <form target="_blank">
            </form>
            HTML,
            Form::widget()->target('_blank')->begin() . PHP_EOL . Form::end(),
        );
    }
}
