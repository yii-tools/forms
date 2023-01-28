<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Helper;

use JsonException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Helper\FilePondHelper;

use function json_encode;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class FilePondHelperTest extends TestCase
{
    /**
     * @throws JsonException
     */
    public function testSave(): void
    {
        FilePondHelper::save(
            [
                0 => json_encode([
                    'id' => 'opqgdavos',
                    'name' => 'test.txt',
                    'type' => 'text/plain',
                    'size' => 7,
                    'metadata' => [],
                    'data' => 'VGVzdE1lCg==',
                ], JSON_THROW_ON_ERROR),
            ],
            dirname(__DIR__) . '/Support/runtime/',
        );

        $this->assertFileExists(dirname(__DIR__) . '/Support/runtime/test.txt');
    }
}
