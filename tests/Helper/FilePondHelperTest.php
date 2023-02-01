<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Helper;

use JsonException;
use PHPUnit\Framework\TestCase;
use Yii\Forms\Helper\FilePondHelper;
use Yii\Forms\Tests\Support\TestTrait;

use function json_encode;

/**
 * @psalm-suppress PropertyNotSetInConstructor
 */
final class FilePondHelperTest extends TestCase
{
    use TestTrait;

    /**
     * @throws JsonException
     */
    public function testSave(): void
    {
        FilePondHelper::save(
            [
                0 => json_encode(
                    [
                        'id' => 'opqgdavos',
                        'name' => 'test.txt',
                        'type' => 'text/plain',
                        'size' => 7,
                        'metadata' => [],
                        'data' => 'VGVzdE1lCg==',
                    ],
                    JSON_THROW_ON_ERROR,
                ),
            ],
            dirname(__DIR__) . '/Support/runtime/',
        );

        $this->assertFileExists(dirname(__DIR__) . '/Support/runtime/test.txt');
    }

    /**
     * @throws JsonException
     */
    public function testSaveWithEmptyData(): void
    {
        FilePondHelper::save(
            [
                0 => json_encode([], JSON_THROW_ON_ERROR),
            ],
            dirname(__DIR__) . '/Support/runtime/',
        );

        $this->assertFileDoesNotExist(dirname(__DIR__) . '/Support/runtime/test.txt');
    }

    /**
     * @throws JsonException
     */
    public function testSaveWithReturningFiles(): void
    {
        $files = FilePondHelper::saveWithReturningFiles(
            [
                0 => json_encode(
                    [
                        'id' => 'opqgdavos',
                        'name' => 'test.txt',
                        'type' => 'text/plain',
                        'size' => 7,
                        'metadata' => [],
                        'data' => 'VGVzdE1lCg==',
                    ],
                    JSON_THROW_ON_ERROR,
                ),
                1 => json_encode(
                    [
                        'id' => 'opqgdavo2',
                        'name' => 'test1.txt',
                        'type' => 'text/plain',
                        'size' => 7,
                        'metadata' => [],
                        'data' => 'VGVzdE1lCg==',
                    ],
                    JSON_THROW_ON_ERROR,
                ),
            ],
            dirname(__DIR__) . '/Support/runtime/',
        );

        $this->assertFileExists(dirname(__DIR__) . '/Support/runtime/test.txt');
        $this->assertFileExists(dirname(__DIR__) . '/Support/runtime/test1.txt');
        $this->assertSame(
            [
                dirname(__DIR__) . '/Support/runtime/test.txt',
                dirname(__DIR__) . '/Support/runtime/test1.txt',
            ],
            $files,
        );
    }

    /**
     * @throws JsonException
     */
    public function testSaveWithReturningFilesEmptyData(): void
    {
        $files = FilePondHelper::saveWithReturningFiles(
            [
                0 => json_encode([], JSON_THROW_ON_ERROR),
            ],
            dirname(__DIR__) . '/Support/runtime/',
        );

        $this->assertFileDoesNotExist(dirname(__DIR__) . '/Support/runtime/test.txt');
        $this->assertSame([], $files);
    }
}
