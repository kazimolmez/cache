<?php


use TT\Facade\Cache;


class CacheTest extends \PHPUnit_Framework_TestCase
{


    public function testPut ()
    {
       Cache::put ( 'library' , 'Cache Library' , 3600 );
    }


    public function testGet ()
    {
        $this->assertEquals ( Cache::get ( 'library' ) , 'Cache Library' );
    }


    public function testHas ()
    {
        $this->assertTrue ( Cache::has ( 'library' ) );
    }


    public function testForget ()
    {
        Cache::forget ( 'library' );

        $this->assertFalse ( Cache::has ( 'library' ) );

    }


}
