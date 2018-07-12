<?php

namespace Towa\SDK\Bookingcom\Model;

class Hotel extends Base
{
    private $type;

    public function __construct($model_data)
    {
        parent::__construct($model_data);
    }

    public function id()
    {
        return $this->get_field('hotel_id');
    }

    public function type_id()
    {
        return $this->get_field('hotel_data')->hotel_type_id;
    }

    public function set_type($type)
    {
        $this->type = $type;
    }

    public function type()
    {
        return $this->type;
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

    public function class()
    {
        return $this->get_field('hotel_data')->class;
    }

    public function minrate()
    {
        $prices = collect($this->get_field('room_data'))
            ->pluck('room_info.min_price')
            ->filter();

        return $prices->isNotEmpty() ? $prices->max() : 0;
    }

    public function maxrate()
    {
        $prices = collect($this->get_field('room_data'))
            ->pluck('room_info.max_price')
            ->filter();

        return $prices->isNotEmpty() ? $prices->max() : 0;
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

    public function photos()
    {
        return $this->get_field('hotel_data')->hotel_photos;
    }

    public function facilities()
    {
        return $this->get_field('hotel_data')->hotel_facilities;
    }

    public function hotel_changed_id()
    {
        return collect($this->get_field('changed_hotels'))
            ->pluck('hotel_id')
            ->to_array();
    }

    public function hotel_closed_id()
    {
        return $this->get_field('closed_hotels');
    }
}
