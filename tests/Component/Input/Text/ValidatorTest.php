<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestTrait;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yii\Forms\Tests\Support\ValidatorFormAttributes;
use Yiisoft\Definitions\Exception\CircularReferenceException;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Definitions\Exception\NotInstantiableException;
use Yiisoft\Factory\NotFoundException;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidatorTest extends TestCase
{
    use TestTrait;

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testGetRuleHtmlAttributes(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="validatorform-username" name="ValidatorForm[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
            HTML,
            Text::widget([new ValidatorForm(), 'username'])->render(),
        );
    }

    /**
     * @throws CircularReferenceException
     * @throws InvalidConfigException
     * @throws NotFoundException
     * @throws NotInstantiableException
     */
    public function testGetRuleHtmlAttributesWithAttributes(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="validatorformattributes-username" name="ValidatorFormAttributes[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
            HTML,
            Text::widget([new ValidatorFormAttributes(), 'username'])->render(),
        );
    }
}
