<?php

return [

    /*
    |--------------------------------------------------------------------------
    | PDO Fetch Style
    |--------------------------------------------------------------------------
    |
    | By default, database results will be returned as instances of the PHP
    | stdClass object; however, you may desire to retrieve records in an
    | array format for simplicity. Here you can tweak the fetch style.
    |
    */

    'fetch' => PDO::FETCH_CLASS,

    /*
    |--------------------------------------------------------------------------
    | Default Database Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the database connections below you wish
    | to use as your default connection for all database work. Of course
    | you may use many connections at once using the Database library.
    |
    */

    'default' => 'mysql',

    /*
    |--------------------------------------------------------------------------
    | Database Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the database connections setup for your application.
    | Of course, examples of configuring each database platform that is
    | supported by Winter CMS is shown below to make development simple.
    |
    | All database work in Winter CMS is done through the PHP PDO facilities
    | so make sure you have the driver for your particular database of
    | choice installed on your machine before you begin development.
    |
    */

    'connections' => [

        'mysql' => [
            'driver' => 'mysql',
            'engine' => 'InnoDB',
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', 'localhost'),
            'database' => env('DB_NAME', 'localhost'),
            'username' => env('DB_USER', 'localhost'),
            'password' => env('DB_PASS', 'localhost'),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'varcharmax' => 191,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Migration Repository Table
    |--------------------------------------------------------------------------
    |
    | This table keeps track of all the migrations that have already run for
    | your application. Using this information, we can determine which of
    | the migrations on disk have not actually be run in the databases.
    |
    */

    'migrations' => 'migrations',


    /*
    |--------------------------------------------------------------------------
    | Use DB configuration for testing
    |--------------------------------------------------------------------------
    |
    | When running plugin tests Winter CMS by default uses SQLite in memory.
    | You can override this behavior by setting `useConfigForTesting` to true.
    |
    | After that Winter CMS will take DB parameters from the config.
    | If file `/config/testing/database.php` exists, config will be read from it,
    | but remember that when not specified it will use parameters specified in
    | `/config/database.php`.
    |
    */

    'useConfigForTesting' => false,

];
