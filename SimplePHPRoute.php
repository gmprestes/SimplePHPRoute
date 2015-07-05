<?php
////////////////////////////////////////////////////////////////////////////////
//
// Copyright (c) 2015 Guilherme M Prestes da Silva
// https://github.com/gmprestes/SimplePHPRoute
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
//
////////////////////////////////////////////////////////////////////////////////

class SimplePHPRoute
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
