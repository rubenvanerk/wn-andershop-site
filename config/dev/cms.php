<?php

return [
    'backendForceSecure' => false,
    'enableAssetCache' => false,

    'storage' => [

        'uploads' => [
            'disk'            => 'local',
            'folder'          => 'uploads',
            'path'            => '/storage/app/uploads',
            'temporaryUrlTTL' => 3600,
        ],

        'media' => [
            'disk'   => 'local',
            'folder' => 'media',
            'path'   => '/storage/app/media',
        ],

        'resized' => [
            'disk'   => 'local',
            'folder' => 'resized',
            'path'   => '/storage/app/resized',
        ],

    ],
];
