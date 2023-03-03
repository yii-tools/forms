<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use Yii\Forms\Input\Text;
use Yii\Forms\Tests\Support\ValidatorForm;
use Yii\Forms\Tests\Support\ValidatorFormAttributes;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class ValidatorTest extends TestCase
{
    public function testGetRuleHtmlAttributes(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="validatorform-username" name="ValidatorForm[username]" type="text" maxlength="10" required minlength="3" pattern="^[a-z]+$">
            HTML,
            Text::widget([new ValidatorForm(), 'username'])->render(),
        );
    }

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
