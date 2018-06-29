<?php

namespace Towa\SDK\Bookingcom\Exceptions;

class API_Call_Exception extends \Exception
{
    private $_endpoint;
    private $_options;
  
    public function __construct($message, $endpoint, array $options, $code = 0, \Exception $previous = null)
    {
        $this->_endpoint = $endpoint;
        $this->_options  = $options;
        parent::__construct($message, $code, $previous);
    }
  
    public function get_endpoint()
    {
        return $this->_endpoint;
    }
  
    public function get_options()
    {
        return $this->_options;
    }
  
    public function __toString()
    {
        $options = print_r($this->_options, true);

        return "$this->message: Endpoint was '{$this->_endpoint}' with options '$options'";
    }
}
