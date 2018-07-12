<?php

namespace Towa\SDK\Bookingcom\Api;

class API_City extends API_Base
{
    public function __construct($username, $password)
    {
        parent::__construct($username, $password);
        $this->_init_default_options();
    }

    public function get_cities(array $options = [])
    {
        $options = array_merge($this->_default_options, $options);

        return $this->_do_request('cities', $options);
    }

    private function _init_default_options()
    {
        $this->_default_options = [];
    }
}
