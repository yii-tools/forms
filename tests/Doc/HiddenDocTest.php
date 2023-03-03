<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Doc;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Field;
use Yii\Forms\Input\Hidden;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class HiddenDocTest extends TestCase
{
    public function testHidden(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <input id="testform-stringhidden" name="TestForm[stringHidden]" type="hidden">
            HTML,
            Hidden::widget([new TestForm(), 'stringHidden'])->render(),
        );
    }

    public function testFieldHidden(): void
    {
        // default.
        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            <input id="testform-stringhidden" name="TestForm[stringHidden]" type="hidden">
            </div>
            HTML,
            Field::widget([Hidden::widget([new TestForm(), 'stringHidden'])])->render(),
        );
    }
}
