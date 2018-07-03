<?php

namespace Towa\SDK\Bookingcom\Model;

use Towa\SDK\Bookingcom\Enum\Description_Types;

class Hotel extends Base
{
    private $_hotel_types;
    private $_facility_types;
    public function __construct($model_data)
    {
        parent::__construct($model_data);
        $this->_hotel_types = [];
        $this->_facility_types = [];
    }
  
    public function id()
    {
        return $this->get_field('hotel_id');
    }
  
    public function hoteltype_id()
    {
        if (!empty($this->get_field('hotel_data')->hotel_type_id)) {
            return $this->get_field('hotel_data')->hotel_type_id;
        } else {
            return [];
        }
    }

    public function add_hotel_types($hotel_types)
    {
        $this->_hotel_types = $hotel_types;
    }
    
    public function hotel_types()
    {
        return $this->_hotel_types;
    }

    public function hotel_facility_id()
    {
        if (!empty($this->get_field('hotel_data')->hotel_type_id)) {
            return $this->get_field('hotel_data')->hotel_type_id;
        } else {
            return [];
        }
    }

    public function add_facility_types($facility_types)
    {
        $this->_facility_types = $facility_types;
    }
    
    public function facility_types()
    {
        return $this->_facility_types;
    }

    public function name()
    {
        return $this->get_field('hotel_data')->name;
    }
  
    public function street()
    {
        return $this->get_field('hotel_data')->address;
    }
  
    public function zipcode()
    {
        return $this->get_field('hotel_data')->zip;
    }
  
    public function city()
    {
        return $this->get_field('hotel_data')->city;
    }
  
    public function city_id()
    {
        return $this->get_field('hotel_data')->city_id;
    }
  
    public function country()
    {
        return $this->get_field('hotel_data')->country;
    }
  
    public function review_score()
    {
        return $this->get_field('hotel_data')->review_score;
    }
  
    public function total_reviews()
    {
        return $this->get_field('hotel_data')->number_of_reviews;
    }
  
    public function total_rooms()
    {
        return $this->get_field('hotel_data')->number_of_rooms;
    }
  
    public function creditcard_required()
    {
        return $this->get_field('hotel_data')->creditcard_required;
    }
  
    public function hotel_class()
    {
        return $this->get_field('hotel_data')->class;
    }
  
    public function minrate()
    {
        $array = array();
        foreach ($this->get_field('room_data') as $data) {
            $price = $data->room_info->min_price;
            array_push($array, $price);
        }
        return min($array);
    }
  
    public function maxrate()
    {
        $array = array();
        foreach ($this->get_field('room_data') as $data) {
            $price = $data->room_info->max_price;
            array_push($array, $price);
        }
        return max($array);
    }
  
    public function url()
    {
        return $this->get_field('hotel_data')->url;
    }
  
    public function checkin_from()
    {
        $info = $this->checkin();
        return isset($info) ? $info->checkin_from : false;
    }
  
    public function checkin_to()
    {
        $info = $this->checkin();
        return isset($info) ? $info->checkin_to : false;
    }
  
    public function checkin()
    {
        return $this->get_field('hotel_data')->checkin_checkout_times;
    }
  
    public function checkout_from()
    {
        $info = $this->checkout();
        return isset($info) ? $info->checkout_from : false;
    }
  
    public function checkout_to()
    {
        $info = $this->checkout();
        return isset($info) ? $info->checkout_to : false;
    }
  
    public function checkout()
    {
        return $this->get_field('hotel_data')->checkin_checkout_times;
    }
  
    public function latitude()
    {
        $location = $this->location();
        return isset($location) ? $location->latitude : false;
    }
  
    public function longitude()
    {
        $location = $this->location();
        return isset($location) ? $location->longitude : false;
    }
  
    public function location()
    {
        return $this->get_field('hotel_data')->location;
    }

    public function welcome_message()
    {
        return $this->get_field('hotel_data')->hotelier_welcome_message;
    }

    public function hotel_description()
    {
        return $this->get_field('hotel_data')->hotel_description;
    }

    public function hotel_important_information()
    {
        return $this->get_field('hotel_data')->hotel_important_information;
    }

    public function hotel_photo()
    {
        return $this->get_field('hotel_data')->hotel_photos;
    }

    public function hotel_facilities()
    {
        return $this->get_field('hotel_data')->hotel_facilities;
    }
}
