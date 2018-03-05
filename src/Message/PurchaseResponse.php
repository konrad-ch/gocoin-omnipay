<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\GoCoin\Message\Response;
use Omnipay\Common\Message\ResponseInterface;

/**
 * GoCoin Purchase Response
 */
class PurchaseResponse extends Response implements ResponseInterface
{
    public function getData()
    {
        return parent::getData() -> json();
    }

    public function isSuccessful()
    {
        if (empty(parent::getData())) {
            return false;
        }
        return parent::getData() -> getStatusCode() == 201;
    }

    public function getTransactionReference()
    {
        if (!empty(parent::getData())) {
            $json = $this -> getData();
            if (isset($json['id'])) {
                return $json['id'];
            }
        }
        return null;
    }

    public function getRedirectUrl()
    {
        if (empty(parent::getData()))
            return null;
        $json = $this->getData();
        if (isset($json["gateway_url"]))
            return $json["gateway_url"];
        return null;
    }
}
