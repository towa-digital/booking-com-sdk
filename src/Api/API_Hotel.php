<?php

namespace Towa\SDK\Bookingcom\Api;

class API_Hotel extends API_Base
{
    public function __construct()
    {
        parent::__construct();
        $this->_init_default_options();
    }
  
    public function get_hotels(array $options = [])
    {
        return $this->_do_request('hotels', $options);
    }

    public function get_hotel_types(array $options = [])
    {
        return $this->_do_request('hotelTypes', $options);
    }

    private function _init_default_options()
    {
        $this->_default_options = [];
    }
}
