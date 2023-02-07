<?php

declare(strict_types=1);

namespace Yii\Forms\Tests\Support;

use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Test\Support\Container\SimpleContainer;
use Yiisoft\Widget\WidgetFactory;

trait TestTrait
{
    /**
     * @throws InvalidConfigException
     */
    protected function setUp(): void
    {
        parent::setUp();

        $container = new SimpleContainer([]);

        WidgetFactory::initialize($container);
    }
}
