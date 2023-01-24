<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yiisoft\Aliases\Aliases;
use Yiisoft\Assets\AssetLoader;
use Yiisoft\Assets\AssetManager;
use Yiisoft\Assets\AssetPublisher;
use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Test\Support\EventDispatcher\SimpleEventDispatcher;
use Yiisoft\Translator\Translator;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\View\WebView;
use Yiisoft\Widget\WidgetFactory;

trait TestTrait
{
    private AssetManager $assetManager;
    private WebView $webView;

    /**
     * @throws InvalidConfigException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $aliases = new Aliases(
            [
                '@root' => __DIR__ . '/runtime',
                '@assets' => '@root',
                '@assetsUrl' => '@root',
                '@baseUrl' => '/',
                '@npm' => dirname(__DIR__, 2) . '/node_modules',
            ],
        );

        $this->assetManager = new AssetManager($aliases, new AssetLoader($aliases, false, []));
        $this->webView = new WebView(dirname(__DIR__) . '/runtime', new SimpleEventDispatcher());
        $this->assetManager = $this->assetManager->withPublisher(new AssetPublisher($aliases));

        $container = new SimpleContainer(
            [
                AssetManager::class => $this->assetManager,
                TranslatorInterface::class => new Translator('en'),
                WebView::class => $this->webView,
            ],
        );

        WidgetFactory::initialize($container);
    }
}
