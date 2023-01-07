<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Widget\Error;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Widget\Error;
use Yii\Support\Assert;

final class RenderTest extends TestCase
{
    use TestTrait;

    public function testFormModelWithAddError(): void
    {
        $testForm = new TestForm();
        $testForm->error()->add('string', 'Error message');
        $errorWidget = Error::widget([$testForm, 'string']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Error message
            </div>
            HTML,
            $errorWidget->render(),
        );
    }

    public function testRender(): void
    {
        $errorWidget = Error::widget([new TestForm(), 'string']);
        $errorWidget = $errorWidget->message('Custom error message.');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Custom error message.
            </div>
            HTML,
            $errorWidget->render(),
        );
    }
}
