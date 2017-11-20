<?php


require_once __DIR__.'/bootstrap.php';



use TT\Cache\Cache;

$cache = new Cache();

/*
|------------------------------------------------------
|  Put Cache Data Example
|------------------------------------------------------
*/


$cache->put('name','Samir',3600); // expires 3600 seconds


//set expires


$cache->expires(3600)->put('expires','3600');
/*
|OR
| $cache->put('expires','3600')->expires(3600);
*/

//set expires minutes

$cache->put('expires-minutes',"60 minutes")->minutes(60);



//Callback



$cache->put('name',function($cache){
  if($cache->has('oldname')) {
    return $cache->get('oldname');
  } else {
    return "Samir";
  }
})->expires(3600);

//Forever

$cache->forever('name','Samir'); // expires forever
