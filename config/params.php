<?php

declare(strict_types=1);

return [
    'yii-tools/forms' => [
        'filepond' => [
            'translator' => [
                'defaultCategory' => 'filepond',
                'path' => '@forms/src/Translator',
            ],
        ],
    ],

    'yiisoft/aliases' => [
        'aliases' => [
            '@forms' => '@vendor/yii-tools/forms',
        ],
    ],
];
