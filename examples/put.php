<?php


require_once __DIR__.'/bootstrap.php';



use TT\Facade\Cache;


/*
|------------------------------------------------------
|  Put Cache Data Example
|------------------------------------------------------
*/


Cache::put('name','Samir',3600); // expires 3600 seconds


//set expires


Cache::expires(3600)->put('expires','3600');
/*
|OR
| Cache::put('expires','3600')->expires(3600);
*/

//set expires minutes

Cache::put('expires-minutes',"60 minutes")->minutes(60);



//Callback



Cache::put('name',function($cache){
  if(Cache::has('oldname')) {
    return Cache::get('oldname');
  } else {
    return "Samir";
  }
})->expires(3600);

//Forever

Cache::forever('name','Samir'); // expires forever

