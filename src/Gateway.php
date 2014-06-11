<?php

namespace Omnipay\GoCoin;

use Omnipay\GoCoin\Message\AuthorizeRequest;
use Omnipay\Common\AbstractGateway;

/**
 * GoCoin Gateway
 *
 * @link http://docs.gocoinapi.apiary.io/
 */
class Gateway extends AbstractGateway
{
    const PROD_ENDPOINT = 'https://api.gocoin.com/api/v1';
    const TEST_ENDPOINT = 'https://api.llamacoin.com/api/v1';
    const MOCK_ENDPOINT = 'https://gocoinapi.apiary-mock.com';

    const PROD_DASHBOARD = 'https://dashboard.gocoin.com';
    const TEST_DASHBOARD = 'https://dashboard.llamacoin.com';

    public function getName()
    {
        return 'GoCoin';
    }

    public function getDefaultParameters()
    {
        return array(
            'token' => '',
            'merchantId' => '',
        );
    }

    public function getToken()
    {
        return $this->getParameter('token');
    }

    public function setToken($value)
    {
        return $this->setParameter('token', $value);
    }

    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        return $this->setParameter('merchantId', $value);
    }

//authorize
//completeAuthorize

    public function getAuthCodeUrl(array $parameters = array())
    {
        if (array_key_exists('testMode', $parameters) && $parameters['testMode']) {
            $endpoint = Gateway::TEST_DASHBOARD;
        } else {
            $endpoint = Gateway::PROD_DASHBOARD;
        }
        $data['response_type'] = 'code';
        $data['client_id'] = $parameters['clientId'];
        $data['redirect_uri'] = $parameters['redirectUri'];
        $data['scope'] = AuthorizeRequest::SCOPE;
        return $endpoint . '/auth?' . http_build_query($data);
    }

    /**
     * @param  array                                     $parameters
     * @return \Omnipay\GoCoin\Message\AuthorizeRequest
     */
    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\GoCoin\Message\AuthorizeRequest', $parameters);
    }

    /**
     * @param  array                                     $parameters
     * @return \Omnipay\GoCoin\Message\PurchaseRequest
     */
    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\GoCoin\Message\PurchaseRequest', $parameters);
    }

    /**
     * @param  array                                     $parameters
     * @return \Omnipay\GoCoin\Message\StatusRequest
     */
    public function status(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\GoCoin\Message\StatusRequest', $parameters);
    }
}
