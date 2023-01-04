<?php

declare(strict_types=1);

namespace Yii\Forms\Asset;

use Yiisoft\Assets\AssetBundle;

final class MarkDownEditorAsset extends AssetBundle
{
    public string|null $basePath = '@assets';
    public string|null $baseUrl = '@assetsUrl';
    public string|null $sourcePath = '@npm/simplemde';
    public array $css = [
        'dist/simplemde.min.css',
    ];
    public array $js = [
        'dist/simplemde.min.js',
    ];
}
