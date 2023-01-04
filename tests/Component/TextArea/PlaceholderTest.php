<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
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
            <textarea id="placeholderform-text" name="PlaceholderForm[text]" placeholder="Enter your text"></textarea>
            HTML,
            TextArea::widget([new PlaceholderForm(), 'text'])->render(),
        );
    }
}
