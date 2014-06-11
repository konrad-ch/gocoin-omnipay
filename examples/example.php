<?php
ini_set('display_errors', 1);
ini_set('xdebug.var_display_max_depth', '10');

include_once '../../autoload.php';
/*
include_once 'gocoin/src/Gateway.php';
include_once 'gocoin/src/Message/Response.php';
include_once 'gocoin/src/Message/AbstractRequest.php';
include_once 'gocoin/src/Message/AuthorizeRequest.php';
include_once 'gocoin/src/Message/AuthorizeResponse.php';
include_once 'gocoin/src/Message/PurchaseRequest.php';
include_once 'gocoin/src/Message/PurchaseResponse.php';
include_once 'gocoin/src/Message/StatusRequest.php';
include_once 'gocoin/src/Message/StatusResponse.php';
*/

use Omnipay\Omnipay;

const TEST_MODE     = FALSE;

//PROD
const MERCHANT_ID   = "YOUR_MERCHANT_ID";
const CLIENT_ID     = 'YOUR_CLIENT_ID';
const CLIENT_SECRET = 'YOUR_CLIENT_SECRET';
//const TOKEN         = 'YOUR_TOKEN_TO_AVOID_AUTH';
const INVOICE_ID    = "SOME_INVOICE_ID";

const REDIRECT_URI  = "http://www.google.com";
const CALLBACK_URI  = "http://localhost/omnipay/webhooks.php";

session_start();

//create an omnipay gateway for gocoin
$gateway = Omnipay::create('GoCoin');

//see if oauth is required
$NEEDS_AUTH = empty($_SESSION) ||
  !array_key_exists('gocoin_access_token', $_SESSION) ||
  empty($_SESSION['gocoin_access_token']);

//see if we need to get a token
if (!defined('TOKEN') && $NEEDS_AUTH)
{
  $params = array(
    'testMode' => TEST_MODE,
    'clientId' => CLIENT_ID,
    'redirectUri' => REDIRECT_URI,
  );

  //get the code from the request, which comes back from an /auth request
  if (array_key_exists('code', $_REQUEST) && !empty($_REQUEST['code']))
  {
    $params['code'] = $_REQUEST['code'];
  }

  //debugging
  //var_dump($params);

  //if no code, make an /auth request
  if (empty($params) || !array_key_exists('code', $params))
  {
    $url = $gateway -> getAuthCodeUrl($params);
    header('Location: ' . $url);
    return;
  }
  //otherwise, request a token
  else
  {
    //add the client secret
    $params['clientSecret'] = CLIENT_SECRET;
    //send the authorize request
    $response = $gateway -> authorize($params) -> send();
    //get the response data (ie: json)
    $data = $response -> getData();
    //store the token into the session for future use
    $_SESSION['gocoin_access_token'] = $data['access_token'];
  }
}

//use the already provided token
if (defined('TOKEN'))
{
  $token = TOKEN;
}
//use the token from the session
else
{
  $token = $_SESSION['gocoin_access_token'];
}

//lookup an existing invoice by id
if (defined('INVOICE_ID'))
{
  //call the gateway to get a status, which will retrieve a gocoin invoice
  $response = $gateway -> status(
    array(
      'testMode' => TEST_MODE,
      'token' => $token,
      'invoiceId' => INVOICE_ID,
    )
  ) -> send();
}
//else, purchase
else
{
  //var_dump($token);
  die("STOP BEFORE PURCHASE!!");

  //call the gateway to purchase, which will create a gocoin invoice
  $response = $gateway -> purchase(
    array(
      'testMode' => TEST_MODE,
      'token' => $token,
      'amount' => '6.00',
      'currency' => 'USD',
      //gocoin specific optional params
      //'merchantId' => MERCHANT_ID,
      //'notificationLevel' => 'all',
      //'priceCurrency' => 'BTC',
      'itemName' => 'Another Item',
      'itemSku' => '654321',
    )
  ) -> send();
}

var_dump($response->isSuccessful());

if ($response -> isSuccessful())
{
  //create invoice was successful
  //print_r($response->getMessage());
  var_dump($response -> getTransactionReference());
  var_dump($response -> getData());
}
else
{
  //create invoice failed: display message
  //print_r($response -> getMessage());
  var_dump($response -> getData());
}
