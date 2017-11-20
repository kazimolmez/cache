<?php


require_once __DIR__ . '/bootstrap.php';


use TT\Cache\Cache;

$cache = new Cache();

/*
|------------------------------------------------------
|  Has Cache Data Example
|------------------------------------------------------
*/


if ($cache->has ( 'name' )) {
    //
} else {
    //
}
