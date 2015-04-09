<?php
  require_once 'vendor/autoload.php';
  
$returnvalue=$_POST['PROCESSING_RESULT'];


if ($returnvalue)
{
file_put_contents('result.json', json_encode($_POST));
if (strstr($returnvalue,"ACK"))
{
// URL after successful transacvtion (change the URL to YOUR success page: e.g. return to shopping)
print "http://95.208.224.17/index.php?status=true";

}
else
{
print "http://95.208.224.17/index.php?status=false";
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
        'endpointUrl' => 'https://test-heidelpay.hpcgw.net/sgw/gtw',
        'account'     => ['holder' => ''],
        'address'     => ['street' => 'foo', 'city' => 'foo', 'zip' => '123', 'country' => 'DE'],
        'contact'     => ['email' => 'mm@bla.com'],
        'frontend'    => [
                            'enabled' => 'true',
                            'response_url' => 'http://95.208.224.17/index.php?response=true',
                            'shop_name' => 'kreawi Online Portal',
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



  $result = '';
  foreach ($t->collectParams() AS $key => $value)
$result .= strtoupper($key).'='.urlencode($value).'&';
$strPOST = stripslashes($result);

echo $strPOST;

//open the request url for the Web Payment Frontend

$cpt = curl_init();
curl_setopt($cpt, CURLOPT_URL, $t->endpointUrl);
curl_setopt($cpt, CURLOPT_SSL_VERIFYHOST, 2);
curl_setopt($cpt, CURLOPT_USERAGENT, "php ctpepost");
curl_setopt($cpt, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($cpt, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($cpt, CURLOPT_POST, 1);
curl_setopt($cpt, CURLOPT_POSTFIELDS, $strPOST);
$curlresultURL = curl_exec($cpt);
$curlerror = curl_error($cpt);
$curlinfo = curl_getinfo($cpt);
curl_close($cpt);
var_dump($returnvalue, $curlresultURL, $curlerror, $curlinfo);

// here you can get all variables returned from the ctpe server (see post integration transactions documentation for help)
//print $strPOST;
// parse results

