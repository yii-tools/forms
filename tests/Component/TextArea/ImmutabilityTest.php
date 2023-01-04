<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Component\TextArea;

use PHPUnit\Framework\TestCase;
use ReflectionException;
use Yii\Forms\Component\TextArea;
use Yii\Forms\Tests\Support\PropertyTypeForm;
use Yii\Forms\Tests\Support\TestTrait;

final class ImmutabilityTest extends TestCase
{
    use TestTrait;

    /**
     * @throws ReflectionException
     */
    public function testImmutability(): void
    {
        $textArea = TextArea::widget([new PropertyTypeForm(), 'string']);

        $this->assertNotSame($textArea, $textArea->cols(10));
        $this->assertNotSame($textArea, $textArea->content(''));
        $this->assertNotSame($textArea, $textArea->rows(1));
        $this->assertNotSame($textArea, $textArea->wrap());
    }
}
