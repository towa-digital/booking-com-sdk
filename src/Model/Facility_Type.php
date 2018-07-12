<?php

namespace Towa\SDK\Bookingcom\Model;

class Facility_Type extends Base
{
    public function __construct($model_data)
    {
        parent::__construct($model_data);
    }

    public function id()
    {
        return $this->get_field('facility_type_id');
    }

    public function name()
    {
        return $this->_model->language;
    }

    public function raw_data()
    {
        return $this->_model;
    }
}
