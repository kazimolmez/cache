<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Cache\Cache;

$cache = new Cache();


/*
|------------------------------------------------------
|  Forget Example
|------------------------------------------------------
*/


$cache->forget ( 'name' );


//Callback

/*

$cache->forget(function($cache){
    return  "name";
});


*/
