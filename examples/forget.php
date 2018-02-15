<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Facade\Cache;




/*
|------------------------------------------------------
|  Forget Example
|------------------------------------------------------
*/


Cache::forget ( 'name' );


//Callback

/*

$cache->forget(function($cache){
    return  "name";
});


*/
