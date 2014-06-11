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
        $data = $this -> getData();
        if (empty($data)) {
            return false;
        }
        return $data -> getStatusCode() >= 200 &&
          $data -> getStatusCode() < 400;
    }

/*
    public function getMessage()
    {
        return $this -> getData() -> json();
    }
*/
}
