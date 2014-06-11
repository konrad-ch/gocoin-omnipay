<?php

namespace Omnipay\GoCoin\Message;

/**
 * GoCoin Status Request
 *
 * @method \Omnipay\GoCoin\Message\StatusResponse send()
 */
class StatusRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('token', 'invoiceId');
        return null;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('GET', "/invoices/{$this -> getInvoiceId()}");
        return $this->response = new StatusResponse($this, $httpResponse);
    }
}
