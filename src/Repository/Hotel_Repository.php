<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_Hotel;
use Towa\SDK\Bookingcom\Model\Hotel as Model_Hotel;
use Towa\SDK\Bookingcom\Model\Hotel_Type;

class Hotel_Repository
{
    private $default_limit;
    private $api_hotel;
    private $langauge;

    public function __construct($username, $password)
    {
        $this->default_limit = 1000; // booking-com default if no rows-param is given
        $this->api_hotel = new API_Hotel($username, $password);
    }

    public function get_hotels($options, $language)
    {
        $this->langauge = $language;
        $options['language'] = $this->langauge;
        $raw_hotels = $this->_get_hotels($options, 'get_hotels');

        return array_map([$this, 'build_hotel'], $raw_hotels);
    }

    public function get_changed_hotels($options)
    {
        return array_map([$this, 'build_hotel'], [$this->get_changed_hotels_raw($options)]);
    }

    public function get_changed_hotels_raw($options)
    {
        if (!isset($options['last_change'])) {
            return false;
        }

        return $this->_get_hotels($options, 'get_changed_hotels');
    }

    public function build_hotel($hotel_data)
    {
        $hotel = new Model_Hotel($hotel_data);
        $hotel->set_type($this->get_hotel_type($hotel));

        return $hotel;
    }

    private function _get_hotels($options, $endpoint)
    {
        // first call
        $hotels = $this->api_hotel->$endpoint($options);
        $offset = $this->default_limit;

        if (!isset($opitons['rows'])) {
            // if this statement is true,
            // it means that there are more hotels then received with the given options
            // so make further call with the offset
            while (is_array($hotels) && count($hotels) >= $offset) {
                $options['offset'] = $offset;
                $hotels_by_offset = $this->api_hotel->$endpoint($options);

                if (is_array($hotels_by_offset)) {
                    $hotels = array_merge($hotels, $hotels_by_offset);
                    $offset += $this->default_limit;
                }
            }
        }

        return $hotels;
    }

    /**
     * A Hotel from booking.com has always one type.
     */
    private function get_hotel_type($hotel)
    {
        if (empty($hotel->type_id())) {
            return false;
        }

        $raw_types = $this->api_hotel->get_hotel_types([
            'hotel_type_ids' => $hotel->type_id(),
            'languages' => $this->langauge,
        ]);

        return collect($raw_types)
            ->map(function ($type) {
                $type->translations = array_pop($type->translations);

                return new Hotel_Type($type);
            })
            ->first();
    }
}
