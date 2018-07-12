<?php

namespace Towa\SDK\Bookingcom\Api;

class API_Region extends API_Base
{
    private $_default_options;

    public function __construct()
    {
        parent::__construct();
        $this->_init_default_options();
    }

    public function get_regions(array $options = [])
    {
        $options = array_merge($this->_default_options, $options);

        return $this->do_request('regions', $options);
    }

    private function _init_default_options()
    {
        $this->_default_options = [
      'country'  => 'at',
      'language' => 'de',
    ];
    }
}
