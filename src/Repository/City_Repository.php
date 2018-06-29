<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_City;
use Towa\SDK\Bookingcom\Model\City;

class City_Repository
{
    private $_api_city;
    public function __construct($username, $password)
    {
        $this->_api_city = new API_City($username, $password);
    }
  
    public function get_cities($options)
    {
        return array_map(function ($city_data) {
            return new City($city_data);
        }, $this->_api_city->get_cities($options));
    }
}
