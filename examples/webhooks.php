<?php
ini_set('display_errors', 1);
ini_set('xdebug.var_display_max_depth', '10');

include_once 'classes/Logger.class.php';
include_once 'classes/DateUtils.class.php';

$date = date('Ymd');
$LOG_FILE = "webhooks.$date.log";

$uri = $_SERVER['REQUEST_URI'];
$remote = $_SERVER['REMOTE_ADDR'];
$method = $_SERVER['REQUEST_METHOD'];
$body = file_get_contents('php://input');

$msg = "[{$method}] incoming request from [$remote] for [{$uri}]";

//dump any request post
if (!empty($body))
{
  //log the request
  Logger::log($LOG_FILE,Logger::DEBUG,$msg);
  Logger::dump($LOG_FILE,Logger::DEBUG,'request body',$body);
  $data = json_decode($body,$array=FALSE);
}
else if (!empty($_REQUEST) && array_key_exists('test', $_REQUEST))
{
  $file = 'json/payment_received.json';
  $data = file_get_contents($file);
  $data = json_decode($data,$array=FALSE);
}

if (empty($data))
{
  die("Error: no data found in request!");
}
else
{
  $event_id = $data -> id;
  $event = $data -> event;
  $payload = $data -> payload;
  $invoice_id = $payload -> id;
  $status = $payload -> status;

  var_dump($event_id);
  var_dump($event);
  var_dump($invoice_id);
  var_dump($status);
  var_dump($payload);

  if ($event == 'invoice_payment_received')
  {
    //TODO: do something with the webhook
  }
  else if ($event == 'invoice_ready_to_ship')
  {
    //TODO: do something with the webhook
  }
  else if ($event == 'invoice_created')
  {
    //TODO: do something with the webhook
  }
}
