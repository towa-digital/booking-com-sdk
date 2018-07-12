<?php

namespace Towa\SDK\Bookingcom\Model;

abstract class Base
{
    protected $_model;

    protected function __construct($model_data)
    {
        $this->_model = $model_data;
    }

    protected function get_field($key)
    {
        return isset($this->_model->$key) ? $this->_model->$key : false;
    }
}
