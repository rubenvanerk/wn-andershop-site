<?php

return [
    'ses' => [
        'key'    => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => env('SES_SECRET', 'eu-central-1'),
    ],
];
