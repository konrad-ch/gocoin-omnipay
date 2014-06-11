<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\GoCoin\Gateway;
use Omnipay\GoCoin\Message\Response;
use Omnipay\Common\Message\ResponseInterface;

/**
 * GoCoin Authorize Response
 */
class AuthorizeResponse extends Response implements ResponseInterface
{
    public function getData()
    {
        if (empty(parent::getData())) {
            return null;
        }
        return parent::getData() -> json();
    }

    public function isSuccessful()
    {
        if (empty($this -> getData())) {
            return false;
        }
        return parent::getData() -> getStatusCode() == 200;
    }

    public function isRedirect()
    {
        return false;
    }

    public function getRedirectMethod()
    {
        return 'GET';
    }

    public function getRedirectUrl()
    {
        return null;
    }

    /**
     * Gets the redirect form data array, if the redirect method is POST.
     */
    public function getRedirectData()
    {
        return null;
    }
}
