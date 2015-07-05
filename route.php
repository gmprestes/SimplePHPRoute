<?php

/**
 * The route class
 */
class route
{
  private $notFoundUrl = '/';
  private $debug = false;

  private $_uri = array();
  private $_method = array();

  function __construct($notFoundUrl = null, $debug = null)
  {
      if($notFoundUrl != null)
        $this->notFoundUrl = $notFoundUrl;

        if($debug != null)
          $this->debug = $debug;
  }

  public function add($url, $method = null)
  {
    $this->_uri[] = '/' . trim($url,'/');

    if($method!= null)
      $this->_method[] = $method;
  }

  public function handle()
  {
    $url = $_SERVER['REQUEST_URI'];
    foreach ($this->_uri as $key => $value)
    {
      if($value == $url)
      {
        $method = $this->_method[$key];
        try
        {
          if(is_string($method))
          {
            if(file_exists($method))
              require $method;
            else
              $this->handleNotFound();
          }
          else
            call_user_func($method);

            return;
          }
          catch(Exception $ex)
          {
            print_r('Error on handle route' . $url);
            if($this->debug)
            {
              print_r('<pre>');
              print_r($ex);
            }
          }
      }
    }

    $this->handleNotFound();
  }

  function handleNotFound()
  {
      header('Location: '.$this->notFoundUrl);
  }

}
