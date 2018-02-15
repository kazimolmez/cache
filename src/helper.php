<?php


if (!function_exists ( 'cache' ))
{
    function cache ( $key = false , $value = false , $expires = 10 )
    {
        if (!$key)
        {
            return ( new TT\Cache\Cache() );
        }
        elseif (!$value)
        {
            return ( new TT\Cache\Cache() )->get ( $key );
        }
        elseif ($key && $value)
        {
            return ( new TT\Cache\Cache() )->put ( $key , $value , $expires );
        }
    }
}


function tt_config($extension,$default = null)
{

  static $config;

  static $_file;

  if (strpos($extension, '.') !== false)
  {
    list($file,$item) = explode('.', $extension ,2);
  }
  else
  {
    $file = $extension;
  }



  if ($_file == $file)
  {
    if (isset($item))
    {
      return $config[$item]  ?? $default;
    }
    else
    {
      return $config;
    }
  }

  $_file = $file;


  if (file_exists(DIR.'/src/Configs/'.$file.'.php'))
  {
    $config = require_once DIR.'/src/Configs/'.$file.'.php';

    if (isset($item))
    {
      return $config[$item]  ?? $default;
    }
    else
    {
      return $config;
    }
  }



}
