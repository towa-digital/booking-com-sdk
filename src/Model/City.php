<?php

namespace Towa\SDK\Bookingcom\Model;

class City extends Base
{
    public function __construct($model_data)
    {
        parent::__construct($model_data);
    }

    public function id()
    {
        return $this->get_field('city_id');
    }

    public function name()
    {
        return $this->get_field('name');
    }

    public function nr_hotels()
    {
        return $this->get_field('nr_hotels');
    }

    public function position()
    {
        return json_encode([
        'latitude'  => $this->latitude(),
        'longitude' => $this->longitude(),
        ]);
    }

    public function latitude()
    {
        return $this->get_field('location')->latitude;
    }

    public function longitude()
    {
        return $this->get_field('location')->longitude;
    }

    public function country()
    {
        return $this->get_field('country');
    }

    public function language()
    {
        return $this->get_field('translations')->language;
    }
}
