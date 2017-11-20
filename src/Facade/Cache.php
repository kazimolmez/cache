<?php


class Cache
{

    public static function __callStatic ( $method , $args )
    {
        $instance = ( new \TT\Cache\Cache() );
        return $instance->{$method}( ...$args );
    }
}
