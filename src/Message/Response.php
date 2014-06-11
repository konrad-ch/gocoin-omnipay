<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\Common\Message\AbstractResponse;

/**
 * GoCoin Response
 */
class Response extends AbstractResponse
{
    public function isSuccessful()
    {
        return $this -> getData() -> getStatusCode() >= 200 &&
          $this -> getData() -> getStatusCode() < 400;
    }

/*
    public function getMessage()
    {
        return $this -> getData() -> json();
    }
*/
}
