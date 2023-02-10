<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Hint;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Hint;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Support\Assert;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class RenderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
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
