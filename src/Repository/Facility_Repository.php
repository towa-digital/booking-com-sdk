<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_Facility;
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
        $array = [];
        $raw_types = $this->_api_facility->get_facility_types($options);
        foreach ($raw_types as $row) {
            $obj = (array) [
                (object) [
                'name' => $row->name,
                'translated_name' => $row->translations[0]->name,
                'language' => $row->translations[0]->language,
                  ],
                ];
            array_push($array, $obj);
        }

        return array_map(function ($facility_data) {
            return new Facility_Type($facility_data);
        }, $array);
    }
}
