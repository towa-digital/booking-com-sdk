<?php

namespace Towa\SDK\Bookingcom\Repository;

use Towa\SDK\Bookingcom\Api\API_Hotel;
use Towa\SDK\Bookingcom\Model\Hotel as Model_Hotel;
use Towa\SDK\Bookingcom\Model\Hotel_Type;

class Hotel_Repository
{
    private $_default_limit;
    private $_api_hotel;
    private $_language;

    public function __construct($username, $password)
    {
        $this->_default_limit = 1000; // booking-com default if no rows-param is given
        $this->_api_hotel = new API_Hotel($username, $password);
    }

    public function get_hotels($options, $language)
    {
        $this->_language = $language;
        $options['language'] = $this->_language;
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
        $hotel->add_hotel_types($this->_get_hotel_types($hotel->hoteltype_id()));

        return $hotel;
    }

    private function _get_hotels($options, $endpoint)
    {
        // first call
        $hotels = $this->_api_hotel->$endpoint($options);
        $offset = $this->_default_limit;

        if (!isset($opitons['rows'])) {
            // if this statement is true,
            // it means that there are more hotels then received with the given options
            // so make further call with the offset
            while (is_array($hotels) && count($hotels) >= $offset) {
                $options['offset'] = $offset;
                $hotels_by_offset = $this->_api_hotel->$endpoint($options);

                if (is_array($hotels_by_offset)) {
                    $hotels = array_merge($hotels, $hotels_by_offset);
                    $offset += $this->_default_limit;
                }
            }
        }

        return $hotels;
    }

    private function _get_hotel_types($hoteltype_id)
    {
        if (empty($hoteltype_id)) {
            return false;
        }

        $raw_types = $this->_api_hotel->get_hotel_types([
            'hotel_type_ids' => $hoteltype_id,
            'languages' => $this->_language,
        ]);

        $language = $this->_language;

        return array_map(function ($data) use ($language) {
            $data->translations = array_pop($data->translations);

            return new Hotel_Type($data);
        }, $raw_types);
    }
}
