<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Concern;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class HasHintTest extends TestCase
{
    public function testGetHint(): void
    {
        $formModel = new TestForm();

        $this->assertSame('String hint', $formModel->getHint('string'));
    }

    public function testGetHintException(): void
    {
        $formModel = new TestForm();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Attribute 'noExist' does not exist.");

        $this->assertSame('', $formModel->getHint('noExist'));
    }
}
