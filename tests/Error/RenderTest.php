<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Error;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Error;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testFormModelWithAddError(): void
    {
        $formModel = new TestForm();

        $formModel->error()->add('string', 'Error content');
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
