<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Files\FileHelper;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Test\Support\EventDispatcher\SimpleEventDispatcher;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;
use Yiisoft\Widget\WidgetFactory;

use function closedir;
use function is_dir;
use function opendir;
use function readdir;

trait TestTrait
{
    private Aliases $aliases;
    private AssetManager $assetManager;
    private WebView $webView;

    /**
     * @throws InvalidConfigException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->aliases = new Aliases(
            [
                '@root' => __DIR__ . '/runtime',
                '@assets' => '@root',
                '@assetsUrl' => '@root',
                '@baseUrl' => '/',
                '@npm' => dirname(__DIR__, 2) . '/node_modules',
            ],
        );
        $this->assetManager = new AssetManager($this->aliases, new AssetLoader($this->aliases, false, []));
        $this->webView = new WebView(dirname(__DIR__) . '/runtime', new SimpleEventDispatcher());
        $this->assetManager = $this->assetManager->withPublisher(new AssetPublisher($this->aliases));

        $container = new SimpleContainer(
            [
                AssetManager::class => $this->assetManager,
                TranslatorInterface::class => new Translator('en'),
                WebView::class => $this->webView,
            ],
        );

        WidgetFactory::initialize($container);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        $this->removeFiles('@root');
    }

    /**
     * Remove files from the directory.
     *
     * @throws RuntimeException
     */
    protected function removeFiles(string $basePath): void
    {
        $handle = opendir($dir = $this->aliases->get($basePath));

        if ($handle === false) {
            throw new RuntimeException("Unable to open directory: $dir");
        }

        while (($file = readdir($handle)) !== false) {
            if ($file === '.' || $file === '..' || $file === '.gitignore') {
                continue;
            }

            $path = $dir . DIRECTORY_SEPARATOR . $file;

            if (is_dir($path)) {
                FileHelper::removeDirectory($path);
            } else {
                FileHelper::unlink($path);
            }
        }

        closedir($handle);
    }
}
