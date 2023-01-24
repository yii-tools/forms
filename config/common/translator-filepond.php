<?php

declare(strict_types=1);

use Yiisoft\Aliases\Aliases;
use Yiisoft\Translator\CategorySource;
use Yiisoft\Translator\IntlMessageFormatter;
use Yiisoft\Translator\Message\Php\MessageSource;

/** @var array $params */

return [
    // Configure application CategorySource
    'translation.filepond' => [
        'definition' => static function (Aliases $aliases) use ($params) {
            return new CategorySource(
                $params['yii-tools/forms']['filepond']['translator']['defaultCategory'],
                new MessageSource($aliases->get($params['yii-tools/forms']['filepond']['translator']['path'])),
                new IntlMessageFormatter(),
            );
        },
        'tags' => ['translation.categorySource'],
    ],
];
