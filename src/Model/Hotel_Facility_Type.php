<?php

namespace Towa\SDK\Bookingcom\Model;

class Hotel_Facility_Type extends Base
{
    public function __construct($model_data)
    {
        parent::__construct($model_data);
    }

    public function id()
    {
        return $this->get_field('hotel_facility_type_id');
    }

    public function type_id()
    {
        return $this->get_field('facility_type_id');
    }

    public function name()
    {
        return $this->_model->translations->name;
    }

    public function language()
    {
        return $this->_model->translations->language;
    }

    public function value_type()
    {
        return $this->get_field('type');
    }

    public function raw_data()
    {
        return $this->_model;
    }
}
