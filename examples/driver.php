<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Facade\Cache;




/*
|------------------------------------------------------
|  Driver Example (database,file,redis,memcache)
|------------------------------------------------------
*/


Cache::driver('database')->put('name','Samir',100);

Cache::forget('name');

