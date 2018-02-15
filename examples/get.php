<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Facade\Cache;



/*
|------------------------------------------------------
|  Get Cache Data Example
|------------------------------------------------------
*/


echo Cache::get ( 'name' );
