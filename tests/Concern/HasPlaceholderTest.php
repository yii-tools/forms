<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Concern;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Tests\Support\TestForm;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class HasPlaceholderTest extends TestCase
{
    public function testGetPlaceholder(): void
    {
        $formModel = new TestForm();

        $this->assertSame('', $formModel->getPlaceholder('string'));
    }

    public function testGetPlaceholderException(): void
    {
        $formModel = new TestForm();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Attribute 'noExist' does not exist.");

        $this->assertSame('', $formModel->getPlaceholder('noExist'));
    }
}
