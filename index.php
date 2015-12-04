<?php
require_once 'vendor/autoload.php';
  
$returnvalue=$_POST['PROCESSING_RESULT'];


if ($returnvalue)
{
file_put_contents('result.json', json_encode($_POST));
if (strstr($returnvalue,"ACK"))
{
// URL after successful transacvtion (change the URL to YOUR success page: e.g. return to shopping)
print "http://domain/index.php?status=true";

}
else
{
print "http://domain/index.php?status=false";
// URL error in transaction (change the URL to YOUR error page)
}
exit;
}

if ($_GET['status']) {
  print $_GET['status'];
  exit;
}


  $t = new Pwintermantel\LibHeidelpay\Transaction;

  $conf = [
        'endpointUrl' => 'https://test-heidelpay.hpcgw.net/',
        'account'     => ['holder' => ''],
        'address'     => ['street' => 'foo', 'city' => 'foo', 'zip' => '123', 'country' => 'DE'],
        'contact'     => ['email' => 'mm@bla.com'],
        'frontend'    => [
                            'enabled' => 'true',
                            'response_url' => 'http://domain/index.php?response=true',
                            'shop_name' => 'fooshop',
                            'language_selector' => 'false',
                            'language' => 'de',
                            'popup' => 'false'
                            ],
        'identification' => ['transactionid' => 'foo1', 'referenceid' => 'foo-1'],
        'name'        => ['family' => 'foo', 'given' => 'bar'],
        'payment'     => ['code' => 'CC.RG'],
        'presentation'=> ['currency' => 'EUR', 'amount' => 5.00, 'usage' => 'foo'],
        'request'     => ['version' => '1.0'],
        'security'    => ['sender' => '31HA07BC8124AD82A9E96D9A35FAFD2A'],
        'user'        => ['login' => '31ha07bc8124ad82a9e96d486d19edaa', 'pwd' => 'password'],
        'transaction' => ['channel' => '31HA07BC81A71E2A47DA94B6ADC524D8', 'mode' =>  Pwintermantel\LibHeidelpay\Transaction\Parameters\Transaction::MODE_CONNECTOR_TEST],
      ];
  $t->setConfig($conf);
  $t->post();
  if ($t->postValidation === 'ACK') {
    header ("Location: {$t->frontend->redirect_url}");
  }
exit;
