<?php

namespace Omnipay\GoCoin\Message;

/**
 * GoCoin Purchase Request
 *
 * @method \Omnipay\GoCoin\Message\PurchaseResponse send()
 */
class PurchaseRequest extends AbstractRequest
{
    public function getData($send = true, $mockResponse = null)
    {
        $this->validate('token', 'amount', 'currency');

        $merchantId = $this -> getMerchantId();

        //automatically lookup the merchant id
        if (empty($merchantId)) {
            $httpResponse = $this -> sendRequest('GET', "/user", null, $send);
            if (empty($httpResponse)) {
                $httpResponse = $mockResponse;
            }
            if (!empty($httpResponse)) {
                $json = $httpResponse -> json();
                $merchantId = $json['merchant_id'];
                $this -> setMerchantId($merchantId);
            }
        }

        $data = array();
        $data['base_price'] = $this -> getAmount();
        $data['base_price_currency'] = $this -> getCurrency();

        $data = parent::addParameter($data, 'notificationLevel', 'notification_level', 'all');
        $data = parent::addParameter($data, 'priceCurrency', 'price_currency', 'BTC');
        $data = parent::addParameter($data, 'confirmationsRequired', 'confirmations_required');
        $data = parent::addParameter($data, 'paymentAddress', 'payment_address');
        $data = parent::addParameter($data, 'serviceFeeRate', 'service_fee_rate');
        $data = parent::addParameter($data, 'usdSpotRate', 'usd_spot_rate');
        $data = parent::addParameter($data, 'spotRate', 'spot_rate');
        $data = parent::addParameter($data, 'inverseSpotRate', 'inverse_spot_rate');
        $data = parent::addParameter($data, 'cryptoPayoutSplit', 'crypto_payout_split');
        $data = parent::addParameter($data, 'orderId', 'order_id');
        $data = parent::addParameter($data, 'itemName', 'item_name');
        $data = parent::addParameter($data, 'itemSku', 'item_sku');
        $data = parent::addParameter($data, 'itemDescription', 'item_description');
        $data = parent::addParameter($data, 'physical', 'physical');
        $data = parent::addParameter($data, 'customerName', 'customer_name');
        $data = parent::addParameter($data, 'customerAddress1', 'customer_address_1');
        $data = parent::addParameter($data, 'customerAddress2', 'customer_address_2');
        $data = parent::addParameter($data, 'customerCity', 'customer_city');
        $data = parent::addParameter($data, 'customerRegion', 'customer_region');
        $data = parent::addParameter($data, 'customerCountry', 'customer_country');
        $data = parent::addParameter($data, 'customerPostalCode', 'customer_postal_code');
        $data = parent::addParameter($data, 'customerEmail', 'customer_email');
        $data = parent::addParameter($data, 'customerPhone', 'customer_phone');
        $data = parent::addParameter($data, 'userDefined1', 'user_defined_1');
        $data = parent::addParameter($data, 'userDefined2', 'user_defined_2');
        $data = parent::addParameter($data, 'userDefined3', 'user_defined_3');
        $data = parent::addParameter($data, 'userDefined4', 'user_defined_4');
        $data = parent::addParameter($data, 'userDefined5', 'user_defined_5');
        $data = parent::addParameter($data, 'userDefined6', 'user_defined_6');
        $data = parent::addParameter($data, 'userDefined7', 'user_defined_7');
        $data = parent::addParameter($data, 'userDefined8', 'user_defined_8');
        $data = parent::addParameter($data, 'redirectUri', 'redirect_url');
        $data = parent::addParameter($data, 'callbackUri', 'callback_url');

        return $data;
    }

    public function sendData($data, $send = true)
    {
        $httpResponse = $this->sendRequest('POST', "/merchants/{$this -> getMerchantId()}/invoices", $data, $send);
        return $this->response = new PurchaseResponse($this, $httpResponse);
    }
}
