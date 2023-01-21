<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Concern;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;

final class HasLabelTest extends TestCase
{
    public function testGenerateLabel(): void
    {
        $formModel = new TestForm();

        $this->assertSame('Array', $formModel->getLabel('array'));
    }

    public function testGetLabel(): void
    {
        $formModel = new TestForm();

        $this->assertSame('String', $formModel->getLabel('string'));
    }

    public function testGetLabelException(): void
    {
        $formModel = new TestForm();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Attribute 'noExist' does not exist.");

        $formModel->getLabel('noExist');
    }
}
