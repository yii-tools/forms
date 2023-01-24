<?php

declare(strict_types=1);

namespace Yii\Forms\Component\Asset;

use Yiisoft\Assets\AssetBundle;
use Yiisoft\Files\PathMatcher\PathMatcher;

/**
 * Asset bundle for the Filepond file upload widget.
 */
final class FilePondAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/filepond';
    public array $css = ['dist/filepond.min.css'];
    public array $js = ['dist/filepond.min.js'];
    public array $depends = [
        FilePondPluginFileEncodeAsset::class,
        FilePondPluginFileValidateSizeAsset::class,
        FilePondPluginFileValidateTypeAsset::class,
        FilePondPluginImageCropAsset::class,
        FilePondPluginImageExifOrientationAsset::class,
        FilePondPluginImagePreviewAsset::class,
    ];

    public function __construct()
    {
        $pathMatcher = new PathMatcher();

        $this->publishOptions = [
            'filter' => $pathMatcher->only(
                '**dist/filepond.min.css',
                '**dist/filepond.min.js',
            ),
        ];
    }
}
