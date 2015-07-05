<?php

/**
 * The route class
 */
class route
{
  private $baseUrl = '/';
  private $_uri = new array();
  private $_method = new array();

  function __construct($baseUrl)
  {
    if($baseUrl != null)
      $this->baseUrl = $baseUrl;
  }

  public function add($url,$method = null)
  {
  $this->_uri[] = '/' . trim($uri,'/');

  if($method!= null)
    $this->_method[] = $method;
  }

  public function handle()
  {
    $uriGetParam = isset($_GET['uri']) ? '/' . $_GET['uri'] : '/';
    foreach ($this->_uri as $key => $value) {
      if(preg_match("#^$value$#",$uriGetParam))
      {
        $method = $this->_method[$key];
        if(is_string($method))
          new $userMethod();
          else
          call_user_func($method);
      }
    }
  }

}
