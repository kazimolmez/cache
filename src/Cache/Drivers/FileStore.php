<?php namespace TT\Cache\Drivers;

use TT\Cache\CacheStore;

class FileStore implements CacheStore
{


    private $path = DIR.'/storage/cache';


    private $fullpath;


    private $put = false;


    private $expires;


    function __construct ()
    {
        $this->path = tt_config('cache.file',['path' => DIR.'/storage/cache'])['path'];
    }


    public function put(String $key , $value ,$expires = 10)
    {

        $this->expires = $expires;

        $this->put     = true;

        $paths   = $this->getpaths($key);

        $this->fullpath = $paths->fullpath;

        if(!$this->has($key))
        {
            $this->createDir($paths);
        }

        file_put_contents($paths->fullpath,serialize($value));

        return $this;


    }



    public function forever(String $key , $value )
    {
        $this->put($key , $value , time());
        return $this;
    }




    public function has($key)
    {
        return $this->existsExpires($this->getpaths($key));
    }



    public function get($key)
    {
        $paths = $this->getpaths($key);

        if($this->existsExpires($paths))
        {
            return unserialize(file_get_contents($paths->fullpath));
        }
        return false;
    }



    public function forget($key)
    {
        $paths = $this->getpaths($key);

        @unlink($paths->fullpath);

        if (@rmdir($this->path.'/'.$paths->path1.'/'.$paths->path2))
        {
            @rmdir($this->path.'/'.$paths->path1);
        }

    }


    private function createDir($paths)
    {

        if(!file_exists($paths->fullpath))
        {
            if(!file_exists($this->path.'/'.$paths->path1.'/'))
            {
                @mkdir($this->path.'/'.$paths->path1.'/',0755,false);
            }
            @mkdir($this->path.'/'.$paths->path1.'/'.$paths->path2.'/');
        }

        return $paths->fullpath;

    }


    public function expires(Int $expires)
    {
        $this->expires = $expires;

        return $this;
    }


    public function minutes(Int $minutes)
    {
        $this->expires = $minutes * 60;

        return $this;
    }


    private function existsExpires($paths)
    {
        if(file_exists($paths->fullpath))
        {
            if(filemtime($paths->fullpath) <= time())
            {
                @unlink($paths->fullpath);
                if (rmdir($this->path.'/'.$paths->path1.'/'.$paths->path2))
                {
                    @rmdir($this->path.'/'.$paths->path1);
                }
                return false;
            }
            return true;
        }
        return false;
    }


    private function getpaths($key)
    {
        $filename = sha1($key);

        $path1    = substr($filename,0,2);

        $path2    = substr($filename,-2);

        $fullpath = $this->path.'/'.$path1.'/'.$path2.'/'.$filename;

        return (object) array('path1' => $path1,'path2' => $path2, 'fullpath' => $fullpath);

    }


    public function flush()
    {
        $this->flushDir();
    }


    private function flushDir($dir = DIR.'/storage/cache')
    {
        foreach (glob($dir.'/*') as $item) {
            if(is_dir($item))
            {
                $this->flushDir($item);
                rmdir($item);
            }
            else
            {
                unlink($item);
            }
        }
    }



    public function __destruct()
    {
        if($this->put && !is_null($this->expires))
        {
            @touch($this->fullpath , time()+ $this->expires);
        }
    }

}
