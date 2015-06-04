<?php
namespace Pwintermantel\LibHeidelpay;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Transaction {

  use Behavior\Configurable;
  use Behavior\Postable;

  /**
   * @var string
   */
  var $endpointUrl = null;


  /**
   * @var Transaction\Parameters\Account
   */
  var $account = null;


  /**
   * @var Transaction\Parameters\Address
   */
  var $address = null;


  /**
   * @var Transaction\Parameters\Contact
   */
  var $contact = null;
  
   
  /**
   * @var Transaction\Parameters\Frontend
   */
  var $frontend = null;


  /**
   * @var Transaction\Parameters\Identification
   */
  var $identification = null;


  /**
   * @var Transaction\Parameters\Name
   */
  var $name = null;


  /**
   * @var Transaction\Parameters\Payment
   */
  var $payment = null;


  /**
   * @var Transaction\Parameters\Presentation
   */
  var $presentation = null;


  /**
   * @var Transaction\Parameters\Request
   */
  var $request = null;

  
  /**
   * @var Transaction\Parameters\Security
   */
  var $security = null;


  /**
   * @var Transaction\Parameters\Transaction
   */
  var $transaction = null;

  
  /**
   * @var Transaction\Parameters\User
   */
  var $user = null;


  
  /**
   * @var Transaction\Parameters\Job
   */
  var $job = null;



  /**
   * @var \GuzzleHttp\Client
   */
  var $httpClient = null;


  /** 
   * @var string
   */
  var $responseStatusCode = null;
  
  /** 
   * @var string
   */
  var $responseRawBody = null;
  

  /**
   * @var string
   **/
  var $processingResult = null;


  /**
   * @var string
   */
  var $xmlGatewaySuffix = 'xml';

  /**
   * @var string
   */
  var $postGatewaySuffix = 'gtwu';


  /**
   * @var array
   */
  var $payloadArray;

  /**
   * @param array $config Configuration Array
   * @return void
   **/
  public function __construct($config = null) {
    if (is_array($config)) {
      $this->setConfig($config); 
    }
    $this->setHttpClient(new \GuzzleHttp\Client());
  }


  public function post() {
    $client = $this->getHttpClient();
    $this->payloadArray = $this->collectParams();
     
    $response = $client->post($this->endpointUrl . $this->postGatewaySuffix, [
      'headers' => ['Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8'],
    'body' => $this->payloadArray]);
    $this->responseRawBody = (string) $response->getBody();
    $this->responseStatusCode = $response->getStatusCode();
    $this->parsePostResponse($response->getBody());
  }


  public function postXml() {
    $client = $this->getHttpClient();
    $this->payloadArray = ['load' => $this->buildXml()];

    $response = $client->post($this->endpointUrl . $this->xmlGatewaySuffix, ['body' => $this->payloadArray, 'headers' => ['Content-Type' => 'application/x-www-form-urlencoded;charset=UTF-8']]);
    $this->responseRawBody = (string) $response->getBody();
    $this->responseStatusCode  = $response->getStatusCode();
    $this->parseXmlResponse($response->getBody());
  }


  public function buildXml() {
    $xml = new \SimpleXMLElement('<Request version="1.0"/>');

    $header = $xml->addChild('Header');
    $header->addChild('Security')->addAttribute('sender', $this->security->sender);

    $t = $xml->addChild('Transaction');
    $t->addAttribute('mode', $this->transaction->mode);
    $t->addAttribute('response', $this->transaction->response);
    $t->addAttribute('channel', $this->transaction->channel);

    $user = $t->addChild('User');
    $user->addAttribute('login', $this->user->login);
    $user->addAttribute('pwd', $this->user->pwd);

    $identification = $t->addChild('Identification');
    $identification->addChild('TransactionID', $this->identification->transactionid);
    $identification->addChild('ReferenceID', $this->identification->referenceid);

    $account = $t->addChild('Account');
    $account->addAttribute('registration', $this->account->uniqueid);

    $job = $t->addChild('Job');
    $job->addAttribute('name', $this->job->name);

    if ($this->job->start) {
      $job->addAttribute('start', $this->job->start);
    }

    if ($this->job->end) {
      $job->addAttribute('end', $this->job->end);
    }
    $payment = $t->addChild('Payment');
    $payment->addAttribute('code', $this->payment->code);
    
    $presentation = $payment->addChild('Presentation');
    $presentation->addChild('Amount', $this->presentation->amount);
    $presentation->addChild('Currency', $this->presentation->currency);
    $presentation->addChild('Usage', $this->presentation->usage);
    

    $job->addChild('Action')->addAttribute('type', 'DB');

    $execution = $job->addChild('Execution');
    $execution->addChild('Hour', $this->job->execution_hour);
    $execution->addChild('DayOfMonth', $this->job->execution_dayofmonth);
    $execution->addChild('Month', $this->job->execution_month);

    /*
    $notice = $job->addChild('Notice');
    $notice->addChild('Number', 1);
    $notice->addChild('Unit', 'WEEK');
    */
    /* 
    $duration = $job->addChild('Duration');
    $duration->addChild('Number', 3);
    $duration->addChild('Unit', 'MONTH');
    */
    return str_replace('<?xml version="1.0"?>', '<?xml version="1.0" encoding="UTF-8"?>', $xml->asXml());
  }

  private function parsePostResponse($body) {
    $data = '';
    parse_str($body, $data);
    $this->responseData    = $data;
    $this->processingResult = $data['PROCESSING_RESULT'];
    $this->postValidation   = $data['POST_VALIDATION'];
    $this->frontend->redirect_url = $data['FRONTEND_REDIRECT_URL'];
  }

  
  private function parseXmlResponse($body) {
    $data = new \SimpleXMLElement($body); 
    $this->responseData     = $data;
    $this->processingResult = (string) $data->Transaction->Processing->Result;
  }



  public function setHttpClient($client) {
    $this->httpClient = $client;
  }

  public function getHttpClient() {
    return $this->httpClient;
  }
}
