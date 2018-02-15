<?php


return array(
  
    'driver' => 'file',



    'file' => array(
        'path' => DIR.'/storage/cache'
    ),

    /*--------------------------------------------------------
     | Database table create { Cache::createDatabaseTable() }
     |--------------------------------------------------------
    */
    'database' => array(
            'host'     => 'localhost',
            'dbname'   => '',
            'user'     => 'root',
            'password' => '',
            'charset'  => 'utf8',
            'table'    => 'cache'
        ),

    'memcache' => array(
            'host' => '127.0.0.1',
            'port' => 11211
        ),

    'redis' => array(
            'host' => '127.0.0.1',
            'port' => 6379
        ),
);
