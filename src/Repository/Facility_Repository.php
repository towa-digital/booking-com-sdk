<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_Facility;
use Towa\SDK\Bookingcom\Model\Facility_Type;

class Facility_Repository
{
    private $api;

    public function __construct($username, $password)
    {
        $this->api = new API_Facility($username, $password);
    }

    public function get_facility_types($options)
    {
        $raw_types = $this->api->get_facility_types($options);

        return collect($raw_types)
            ->map(function ($type) {
                $type->translations = array_pop($type->translations);

                return new Facility_Type($type);
            })
            ->toArray();
    }
}
