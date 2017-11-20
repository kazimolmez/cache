<?php


if (!function_exists ( 'cache' )) {
    function cache ( $key = false , $value = false , $expires = 10 )
    {
        if (!$key) {
            return ( new TT\Cache\Cache() );
        } elseif (!$value) {
            return ( new TT\Cache\Cache() )->get ( $key );
        } elseif ($key && $value) {
            return ( new TT\Cache\Cache() )->put ( $key , $value , $expires );
        }
    }
}
