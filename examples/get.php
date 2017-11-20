<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Cache\Cache;

$cache = new Cache();


/*
|------------------------------------------------------
|  Get Cache Data Example
|------------------------------------------------------
*/


echo $cache->get ( 'name' );
