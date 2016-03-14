<?php namespace App\Library;

class Da{
  function __construct(){
    var_dump('cons');
  }

  public static function da(){
    var_dump(__CLASS__);
  }
}
