<?php

return [
    'driver' => 'smtp',
    'host' => 'localhost',
    'port' => env('SMTP_PORT', '25'),
    'encryption' => '',
    'username' => null,
    'password' => null,
];
