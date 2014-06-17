<?php

namespace Omnipay\GoCoin\Message;

use Omnipay\GoCoin\Gateway;

/**
 * GoCoin Abstract Request
 *
 * @method \Omnipay\GoCoin\Message\Response send()
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    public function getMerchantId()
    {
        return $this->getParameter('merchantId');
    }

    public function setMerchantId($value)
    {
        $this->setParameter('merchantId', $value);
    }

    public function getInvoiceId()
    {
        return $this->getParameter('invoiceId');
    }

    public function setInvoiceId($value)
    {
        $this->setParameter('invoiceId', $value);
    }

    public function getCode()
    {
        return $this->getParameter('code');
    }

    public function setCode($value)
    {
        $this->setParameter('code', $value);
    }

    public function getClientId()
    {
        return $this->getParameter('clientId');
    }

    public function setClientId($value)
    {
        $this->setParameter('clientId', $value);
    }

    public function getClientSecret()
    {
        return $this->getParameter('clientSecret');
    }

    public function setClientSecret($value)
    {
        $this->setParameter('clientSecret', $value);
    }

    #     #  #######  ######   #     #  #######  #######  #    #   #####
    #  #  #  #        #     #  #     #  #     #  #     #  #   #   #     #
    #  #  #  #        #     #  #     #  #     #  #     #  #  #    #
    #  #  #  #####    ######   #######  #     #  #     #  ###      #####
    #  #  #  #        #     #  #     #  #     #  #     #  #  #          #
    #  #  #  #        #     #  #     #  #     #  #     #  #   #   #     #
     ## ##   #######  ######   #     #  #######  #######  #    #   #####

    public function getRedirectUri()
    {
        return $this->getParameter('redirectUri');
    }

    public function setRedirectUri($value)
    {
        $this->setParameter('redirectUri', $value);
    }

    public function getCallbackUri()
    {
        return $this->getParameter('callbackUri');
    }

    public function setCallbackUri($value)
    {
        $this->setParameter('callbackUri', $value);
    }

    #######  ######   #######  ###  #######  #     #     #     #
    #     #  #     #     #      #   #     #  ##    #    # #    #
    #     #  #     #     #      #   #     #  # #   #   #   #   #
    #     #  ######      #      #   #     #  #  #  #  #     #  #
    #     #  #           #      #   #     #  #   # #  #######  #
    #     #  #           #      #   #     #  #    ##  #     #  #
    #######  #           #     ###  #######  #     #  #     #  #######

    public function getNotificationLevel()
    {
        return $this->getParameter('notificationLevel');
    }

    public function setNotificationLevel($value)
    {
        $this->setParameter('notificationLevel', $value);
    }

    public function getPriceCurrency()
    {
        return $this->getParameter('priceCurrency');
    }

    public function setPriceCurrency($value)
    {
        $this->setParameter('priceCurrency', $value);
    }

    public function getConfirmationsRequired()
    {
        return $this->getParameter('confirmationsRequired');
    }

    public function setConfirmationsRequired($value)
    {
        $this->setParameter('confirmationsRequired', $value);
    }

    public function getPaymentAddress()
    {
        return $this->getParameter('paymentAddress');
    }

    public function setPaymentAddress($value)
    {
        $this->setParameter('paymentAddress', $value);
    }

    public function getServiceFeeRate()
    {
        return $this->getParameter('serviceFeeRate');
    }

    public function setServiceFeeRate($value)
    {
        $this->setParameter('serviceFeeRate', $value);
    }

    public function getUsdSpotRate()
    {
        return $this->getParameter('usdSpotRate');
    }

    public function setUsdSpotRate($value)
    {
        $this->setParameter('usdSpotRate', $value);
    }

    public function getSpotRate()
    {
        return $this->getParameter('spotRate');
    }

    public function setSpotRate($value)
    {
        $this->setParameter('spotRate', $value);
    }

    public function getInverseSpotRate()
    {
        return $this->getParameter('inverseSpotRate');
    }

    public function setInverseSpotRate($value)
    {
        $this->setParameter('inverseSpotRate', $value);
    }

    public function getCryptoPayoutSplit()
    {
        return $this->getParameter('cryptoPayoutSplit');
    }

    public function setCryptoPayoutSplit($value)
    {
        $this->setParameter('cryptoPayoutSplit', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderId');
    }

    public function setOrderId($value)
    {
        $this->setParameter('orderId', $value);
    }

    public function getItemName()
    {
        return $this->getParameter('itemName');
    }

    public function setItemName($value)
    {
        $this->setParameter('itemName', $value);
    }

    public function getItemSku()
    {
        return $this->getParameter('itemSku');
    }

    public function setItemSku($value)
    {
        $this->setParameter('itemSku', $value);
    }

    public function getItemDescription()
    {
        return $this->getParameter('itemDescription');
    }

    public function setItemDescription($value)
    {
        $this->setParameter('itemDescription', $value);
    }

    public function getPhysical()
    {
        return $this->getParameter('physical');
    }

    public function setPhysical($value)
    {
        $this->setParameter('physical', $value);
    }

    public function getCustomerName()
    {
        return $this->getParameter('customerName');
    }

    public function setCustomerName($value)
    {
        $this->setParameter('customerName', $value);
    }

    public function getCustomerAddress1()
    {
        return $this->getParameter('customerAddress1');
    }

    public function setCustomerAddress1($value)
    {
        $this->setParameter('customerAddress1', $value);
    }

    public function getCustomerAddress2()
    {
        return $this->getParameter('customerAddress2');
    }

    public function setCustomerAddress2($value)
    {
        $this->setParameter('customerAddress2', $value);
    }

    public function getCustomerCity()
    {
        return $this->getParameter('customerCity');
    }

    public function setCustomerCity($value)
    {
        $this->setParameter('customerCity', $value);
    }

    public function getCustomerRegion()
    {
        return $this->getParameter('customerRegion');
    }

    public function setCustomerRegion($value)
    {
        $this->setParameter('customerRegion', $value);
    }

    public function getCustomerCountry()
    {
        return $this->getParameter('customerCountry');
    }

    public function setCustomerCountry($value)
    {
        $this->setParameter('customerCountry', $value);
    }

    public function getCustomerPostalCode()
    {
        return $this->getParameter('customerPostalCode');
    }

    public function setCustomerPostalCode($value)
    {
        $this->setParameter('customerPostalCode', $value);
    }

    public function getCustomerEmail()
    {
        return $this->getParameter('customerEmail');
    }

    public function setCustomerEmail($value)
    {
        $this->setParameter('customerEmail', $value);
    }

    public function getCustomerPhone()
    {
        return $this->getParameter('customerPhone');
    }

    public function setCustomerPhone($value)
    {
        $this->setParameter('customerPhone', $value);
    }

    public function getUserDefined1()
    {
        return $this->getParameter('userDefined1');
    }

    public function setUserDefined1($value)
    {
        $this->setParameter('userDefined1', $value);
    }

    public function getUserDefined2()
    {
        return $this->getParameter('userDefined2');
    }

    public function setUserDefined2($value)
    {
        $this->setParameter('userDefined2', $value);
    }

    public function getUserDefined3()
    {
        return $this->getParameter('userDefined3');
    }

    public function setUserDefined3($value)
    {
        $this->setParameter('userDefined3', $value);
    }

    public function getUserDefined4()
    {
        return $this->getParameter('userDefined4');
    }

    public function setUserDefined4($value)
    {
        $this->setParameter('userDefined4', $value);
    }

    public function getUserDefined5()
    {
        return $this->getParameter('userDefined5');
    }

    public function setUserDefined5($value)
    {
        $this->setParameter('userDefined5', $value);
    }

    public function getUserDefined6()
    {
        return $this->getParameter('userDefined6');
    }

    public function setUserDefined6($value)
    {
        $this->setParameter('userDefined6', $value);
    }

    public function getUserDefined7()
    {
        return $this->getParameter('userDefined7');
    }

    public function setUserDefined7($value)
    {
        $this->setParameter('userDefined7', $value);
    }

    public function getUserDefined8()
    {
        return $this->getParameter('userDefined8');
    }

    public function setUserDefined8($value)
    {
        $this->setParameter('userDefined8', $value);
    }

    public function setParam($name, $value)
    {
        $this->setParameter($name, $value);
    }

    public function addParameter($data, $param_key, $data_key, $default = null)
    {
        if (empty($data)) {
            return $data;
        }
        //dynamically construct the method name, per naming conventions
        $method = 'get' . strtoupper(substr($param_key, 0, 1)) . substr($param_key, 1);
        //check the method first
        if (method_exists($this, $method) && !empty($this -> $method())) {
            $data[$data_key] = $this -> $method();
        } elseif (!empty($this->getParameter($param_key))) {
            //make a call to the underlying parameters next
            $data[$data_key] = $this->getParameter($param_key);
        } else {
            if (!empty($default)) {
                $data[$data_key] = $default;
            }
        }
        return $data;
    }

    public function sendRequest($method, $action, $data = null, $send = true)
    {
        $endpoint = Gateway::ENDPOINT;

        //the url is a combination of the endpoint and the action
        $url = $endpoint . $action;

        //build the query string for a GET
        if ($method == 'GET') {
            $body = $data ? http_build_query($data) : null;
            $headers = null;
        } else {
            //everything else is assumed to be a json request
            $body = $data ? json_encode($data, JSON_PRETTY_PRINT) : null;
            $headers = array('Content-Type' => 'application/json');
        }

        //set a couple extra options
        $options = array(
            'allow_redirects' => false,
            'exceptions' => false,
        );

        //create the request
        $httpRequest = $this->httpClient->createRequest($method, $url, $headers, $body, $options);

        //add the token if present
        if (!empty($this -> getToken())) {
            $httpRequest->setHeader('Authorization', "Bearer ".$this->getToken());
        }

        //debug
        if ($action != '/user' && $action != '/auth') {
            //var_dump($httpRequest -> getBody() -> __toString());
        }
        //die("STOPPING BEFORE REQUEST SEND");

        //send the request
        if ($send) {
            return $httpRequest->send();
        } else {
            return null;
        }
    }
}
