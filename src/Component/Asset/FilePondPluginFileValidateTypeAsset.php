<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Asset bundle for the Filepond plugin file validate size.
 */
final class FilePondPluginFileValidateTypeAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond-plugin-file-validate-type';
    public array $js = ['dist/filepond-plugin-file-validate-type.min.js'];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**dist/filepond-plugin-file-validate-type.min.js',
            ),
        ];
    }
}
