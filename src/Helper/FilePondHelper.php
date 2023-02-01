<?php

declare(strict_types=1);

namespace Yii\Forms\Helper;

use JsonException;

use function base64_decode;
use function fclose;
use function fopen;
use function fwrite;
use function is_string;
use function json_decode;
use function pathinfo;
use function preg_replace;

/**
 * FilePondHelper provides helper methods for working with FilePond.
 */
final class FilePondHelper
{
    /**
     * @throws JsonException
     */
    public static function save(array $files, string $path): void
    {
        self::procesedFile($files, $path);
    }

    /**
     * @throws JsonException
     */
    public static function saveWithReturningFiles(array $files, string $path): array
    {
        return self::procesedFile($files, $path);
    }

    private static function procesedFile(array $files, string $path): array
    {
        $savedFiles = [];

        /** @psalm-var array<array-key, string|null> $files */
        foreach ($files as $file) {
            if (is_string($file) && $file !== '') {
                /** @psalm-var object|false|null $file */
                $file = json_decode($file, false, flags: JSON_THROW_ON_ERROR);
            }

            if (is_object($file) && is_string($file->data) && is_string($file->name)) {
                $filename = self::sanitizeFilename($file->name);

                $result = self::writeFile($path, base64_decode($file->data), $filename);

                if ($result) {
                    $savedFiles[] = $path . $filename;
                }
            }
        }

        return $savedFiles;
    }

    private static function sanitizeFilename(string $filename): string
    {
        $extension = '';
        $name = '';

        $info = pathinfo($filename);

        if (isset($info['filename'])) {
            $name = self::sanitizeFilenamePart($info['filename']);
        }

        if (isset($info['extension'])) {
            $extension = self::sanitizeFilenamePart($info['extension']);
        }

        return ($name !== '' ? $name : '_') . '.' . $extension;
    }

    private static function sanitizeFilenamePart(string $str): string
    {
        return preg_replace("/[^a-zA-Z0-9\_\s]/", '', $str);
    }

    private static function writeFile(string $path, string $data, string $filename): bool
    {
        $handle = fopen($path . $filename, 'wb');
        $result = fwrite($handle, $data);

        fclose($handle);

        return $result !== false;
    }
}
