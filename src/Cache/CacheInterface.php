<?php namespace TT\Cache;

/**
 * @author  Samir Rustamov <rustemovv96@gmail.com>
 * @link https://github.com/SamirRustamov/Cache
 */


interface CacheInterface
{


    public function put ( String $key , $value , Int $expires = 10 );


    public function forever ( String $key , $value );


    public function has ( $key );


    public function get ( $key );


    public function forget ( $key );


    public function expires ( Int $expires );


    public function minutes ( Int $minutes );


}
