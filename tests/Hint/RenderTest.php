<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Hint;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Hint;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Support\Assert;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    public function testFormModelWithAddHint(): void
    {
        $errorWidget = Hint::widget([new TestForm(), 'string']);

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            String hint
            </div>
            HTML,
            $errorWidget->render(),
        );
    }

    public function testRender(): void
    {
        $hintWidget = Hint::widget([new TestForm(), 'string']);
        $hintWidget = $hintWidget->content('Custom string hint');

        Assert::equalsWithoutLE(
            <<<HTML
            <div>
            Custom string hint
            </div>
            HTML,
            $hintWidget->render(),
        );
    }
}
