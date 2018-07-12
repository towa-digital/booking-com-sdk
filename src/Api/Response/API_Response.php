<?php

namespace Towa\SDK\Bookingcom\Api\Response;

use Unirest\Response;

class API_Response
{
    private $_response;

    public function __construct(Response $response)
    {
        $this->_response = $response;
    }

    public function was_successful()
    {
        $response_code = intval($this->_response->code);

        return 200 <= $response_code && $response_code <= 299;
    }

    public function was_not_successful()
    {
        return false === $this->was_successful();
    }

    public function body()
    {
        return $this->_response->body->result;
    }
}
