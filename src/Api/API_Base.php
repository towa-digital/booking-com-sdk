<?php
namespace Towa\SDK\Bookingcom\Api;

use Unirest;
use Towa\SDK\Bookingcom\Api\Response\API_Response;
use Towa\SDK\Bookingcom\Exceptions\API_Call_Exception;
use Dotenv\Dotenv;

$dotenv = new Dotenv(__DIR__. '/../../');
$dotenv->load();

abstract class API_Base
{
    protected $_api_base;
    protected $_username;
    protected $_password;
    protected $_default_options;
  
    protected function __construct()
    {
        $this->_username = $_ENV['USERNAME'];
        $this->_password = $_ENV['PASSWORD'];
        $this->_api_base = 'https://distribution-xml.booking.com/2.0/json/';
    }
  
    protected function _do_request($endpoint, array $options = [])
    {
        $options      = $this->_prepare_options($options);
        $endpoint_url = $this->_build_enpoint_url($endpoint, $options);
        $request      = $this->_init_request();
        $response     = new API_Response($request::get($endpoint_url));
       
        if ($response->was_successful()) {
            return $response->body();
        } else {
            throw new API_Call_Exception($message = 'Error during API Call', $endpoint, $options);
        }
    }
  
    private function _prepare_options(array $options = [])
    {
        return array_merge($this->_default_options, $options);
    }
  
    private function _build_enpoint_url($endpoint, array $options = [])
    {
        return sprintf('%1$s%2$s?%3$s', $this->_api_base, $endpoint, http_build_query($options));
    }
  
    private function _init_request()
    {
        $request = new Unirest\Request();
        $request::verifyPeer(false); // needed in development --> ssl requests
        $request::auth($this->_username, $this->_password);
        return $request;
    }
}
