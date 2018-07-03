<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_Facility;
use Towa\SDK\Bookingcom\Enum\Language_Codes;
use Towa\SDK\Bookingcom\Model\Facility_Type;

class Facility_Repository
{
    private $_api_facility;
  
    public function __construct($username, $password)
    {
        $this->_api_facility = new API_Facility($username, $password);
    }

    public function get_facility_types($options)
    {
        return array_map(function ($facility_data) {
            return new Facility_Type($facility_data);
        }, $this->_api_facility->get_facility_types($options));
    }
}
