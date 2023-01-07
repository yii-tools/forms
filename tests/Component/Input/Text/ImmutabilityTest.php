<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\Input\Text;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\Input\Text;
use Yii\Forms\Tests\Support\TestForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $text = Text::widget([new TestForm(), 'string']);

        $this->assertNotSame($text, $text->dirname('test.dir'));
        $this->assertNotSame($text, $text->maxlength(0));
        $this->assertNotSame($text, $text->minlength(0));
        $this->assertNotSame($text, $text->pattern(''));
        $this->assertNotSame($text, $text->placeholder(''));
        $this->assertNotSame($text, $text->size(0));
    }
}
