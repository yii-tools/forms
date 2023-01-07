<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\PlaceholderForm;
use Yii\Forms\Tests\Support\TestTrait;

final class PlaceholderTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testRender(): void
    {
        $this->assertSame(
            <<<HTML
            <input id="placeholderform-text" name="PlaceholderForm[text]" type="text" placeholder="Enter your text">
            HTML,
            Text::widget([new PlaceholderForm(), 'text'])->render(),
        );
    }
}
