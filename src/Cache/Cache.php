<?php namespace TT\Cache;

/**
 * @author  Samir Rustamov <rustemovv96@gmail.com>
 * @link https://github.com/SamirRustamov/Cache
 */


use TT\Cache\CacheInterface;


class Cache implements CacheInterface
{


    private static $config;


    private $fullpath;


    private $put     = false;


    private $expires = 10;


    /**
     * Cache constructor.
     */
    function __construct()
    {
      if(is_null(self::$config)) {
        self::$config = array('files'=> BASEDIR.'/storage/cache');
      }

    }


    /**
     * @param String $key
     * @param $value
     * @param Int $expires
     * @return $this
     */
    public function put( String $key , $value , Int $expires = 10)
    {


      $this->expires  = $expires;

      $this->put      = true;

      $paths          = $this->getPaths($key);

      $this->fullpath = $paths->fullpath;

      if(!$this->has($key)) {
        $this->createDir($paths);
      }

      if(is_callable($value)) {
        $value = call_user_func($value,$this);
      }

      file_put_contents($paths->fullpath,serialize($value));

      return $this;


    }


    /**
     * @param String $key
     * @param $value
     * @return Cache
     */
    public function forever( String $key , $value )
    {
      return $this->put($key , $value , time());
    }


    /**
     * @param $key
     * @return bool
     */
    public function has( $key)
    {
      if(is_callable($key)) {
        $key = call_user_func($key,$this);
      }
      return $this->existsExpires($this->getPaths($key));
    }


    /**
     * @param $key
     * @return bool|mixed
     */
    public function get( $key)
    {
      if(is_callable($key)) {
        $key = call_user_func($key,$this);
      }

      $paths = $this->getPaths($key);

      if($this->existsExpires($paths)) {
          return unserialize(file_get_contents($paths->fullpath));
      }
      return false;
    }


    /**
     * @param $key
     * @return $this
     */
    public function forget( $key)
    {
      if(is_callable($key)) {
        $key = call_user_func($key,$this);
      }

      $paths = $this->getPaths($key);

      @unlink($paths->fullpath);

      if (@rmdir(self::$config['files'].'/'.$paths->path1.'/'.$paths->path2)) {

         @rmdir(self::$config['files'].'/'.$paths->path1);

      }

      return $this;

    }


    /**
     * @param $paths
     * @return mixed
     */
    private function createDir( $paths)
    {

      if(!file_exists($paths->fullpath)) {
        if(!file_exists(self::$config['files'].'/'.$paths->path1.'/')) {
           @mkdir(self::$config['files'].'/'.$paths->path1.'/',0755,false);
        }
        @mkdir(self::$config['files'].'/'.$paths->path1.'/'.$paths->path2.'/',0755,false);
      }

      return $paths->fullpath;

    }


    /**
     * @param Int $expires
     * @return $this
     */
    public function expires( Int $expires)
    {
      $this->expires = $expires;

      return $this;
    }


    /**
     * @param Int $minutes
     * @return $this
     */
    public function minutes( Int $minutes)
    {
      $this->expires = $minutes * 60;

      return $this;
    }


    /**
     * @param $paths
     * @return bool
     */
    private function existsExpires( $paths)
    {
      if(file_exists($paths->fullpath)) {
        if(filemtime($paths->fullpath) <= time()) {
           @unlink($paths->fullpath);
           if (rmdir(self::$config['files'].'/'.$paths->path1.'/'.$paths->path2)) {
                @rmdir(self::$config['files'].'/'.$paths->path1);
           }
           return false;
        }
        return true;
      }
      return false;
    }


    /**
     * @param $key
     * @return object
     */
    private function getPaths( $key)
    {
      $filename = sha1($key);

      $path1    = substr($filename,0,2);

      $path2    = substr($filename,-2);

      $fullpath = self::$config['files'].'/'.$path1.'/'.$path2.'/'.$filename;

      return (object) array('path1' => $path1,'path2' => $path2, 'fullpath' => $fullpath);

    }


    /**
     * @param $key
     * @return bool|mixed
     */
    public function __get( $key)
    {
      return $this->get($key);
    }


    /**
     *
     */
    function __destruct()
    {
      if($this->put) {
        touch($this->fullpath , time()+ $this->expires);
      }
    }







}
