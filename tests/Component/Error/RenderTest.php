<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Error;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Error;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;

final class RenderTest extends TestCase
{
    use TestTrait;

    public function testFormModelWithAddError(): void
    {
        $formModel = new TestForm();

        $formModel->addError('string', 'Error content');
        $errorWidget = Error::widget([$formModel, 'string']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Error content
            </div>
            HTML,
            $errorWidget->render(),
        );
    }

    public function testRender(): void
    {
        $errorWidget = Error::widget([new TestForm(), 'string']);
        $errorWidget = $errorWidget->content('Custom error content');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Custom error content
            </div>
            HTML,
            $errorWidget->render(),
        );
    }
}
