<?php


use TT\Cache\Cache;


class CacheTest extends \PHPUnit_Framework_TestCase
{


    public function testPut ()
    {
        $cache = new Cache();

        $this->assertEquals ( $cache->put ( 'library' , 'Cache Library' , 3600 ) , $cache );
    }


    public function testGet ()
    {
        $cache = new Cache();

        $this->assertEquals ( $cache->get ( 'library' ) , 'Cache Library' );
    }


    public function testHas ()
    {
        $cache = new Cache();

        $this->assertTrue ( $cache->has ( 'library' ) );
    }


    public function testForget ()
    {
        $cache = new Cache();

        $cache->forget ( 'library' );

        $this->assertFalse ( $cache->has ( 'library' ) );

    }


}
