<?php

namespace Towa\SDK\Bookingcom\Model;

class Hotel_Type extends Base
{
    public function __construct($model_data)
    {
        parent::__construct($model_data);
    }

    public function id()
    {
        return $this->get_field('hotel_type_id');
    }
  
    public function name()
    {
        return $this->get_field('name');
    }
  
    public function language()
    {
        return $this->get_field('translations')->language;
    }
    
    public function raw_data()
    {
        return $this->_model;
    }
}
