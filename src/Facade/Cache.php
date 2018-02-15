<?php namespace TT\Facade;


class Cache
{
    public static function __callStatic ( $method , $args )
    {
        return ( new \TT\Cache\Cache() )->{$method}( ...$args );
    }
}
