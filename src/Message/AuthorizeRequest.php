<?php

namespace Omnipay\GoCoin\Message;

/**
 * GoCoin Purchase Request
 *
 * @method \Omnipay\GoCoin\Message\PurchaseResponse send()
 */
class AuthorizeRequest extends AbstractRequest
{
    const SCOPE = "user_read invoice_read_write";

    public function getData()
    {
//var_dump($this->getParameters());
        $this->validate('clientId', 'clientSecret', 'code', 'redirectUri');

        //response_type=code&client_id=CLIENT_ID&redirect_uri=REDIRECT_URI&scope=user_read&state=optional

        $data = array();
        $data['grant_type'] = 'authorization_code';
        $data['code'] = $this -> getCode();
        $data['client_id'] = $this -> getClientId();
        $data['client_secret'] = $this -> getClientSecret();
        $data['redirect_uri'] = $this -> getRedirectUri();

        return $data;
    }

    public function sendData($data)
    {
        $httpResponse = $this->sendRequest('POST', "/oauth/token", $data);
//var_dump($httpResponse);
//var_dump($httpResponse -> getBody() -> __toString());
        return $this->response = new AuthorizeResponse($this, $httpResponse);
    }
}
