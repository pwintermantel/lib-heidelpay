<?php
namespace Pwintermantel\LibHeidelpay;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Query {

  use Behavior\Configurable;
  use Behavior\Postable;


  const QUERY_TYPE_STANDARD = 'STANDARD';
  const TRANSACTION_TYPE_PAYMENT = 'PAYMENT';
  const QUERY_TYPE_LINKED_TRANSACTIONS = 'LINKED_TRANSACTIONS';
  const QUERY_TYPE_AVAILABLE_TRANSACTIONS = 'AVAILABLE_TRANSACTIONS';
  const QUERY_TYPE_ACTIVE_LINKED_TRANSACTIONS = 'ACTIVE_LINKED_TRANSACTIONS';
  const QUERY_TYPE_AVAILABLE_LINKED_TRANSACTIONS = 'AVAILABLE_LINKED_TRANSACTIONS';

  const LEVEL_CHANNEL = 'CHANNEL';
  const LEVEL_MERCHANT = 'MERCHANT';
  const LEVEL_PSP = 'PSP';


  const SOURCE_SCHEDULER = 'SCHEDULER';

  /**
   * @var string
   */
  var $endpointUrl = null;


  /**
   * @var Transaction\Parameters\Account
   */
  var $account = null;

  

  /**
   * @var Transaction\Parameters\Security
   */
  var $security = null;



  /**
   * @var Transaction\Parameters\Identification
   */
  var $identification = null;

  
  /**
   * @var Transaction\Parameters\Transaction
   */
  var $transaction = null;

  
  /**
   * @var Transaction\Parameters\User
   */
  var $user = null;

  
  
  /**
   * @var Transaction\Parameters\Types
   */
  var $types = null;

  /**
   * @var string
   */
  var $source;


  /**
   * @var string
   */
  var $type = '';


  /**
   * @var string
   */
  var $level = '';


  /**
   * @var string
   */
  var $entity = '';


  /**
   * @var \DateTime
   */
  var $periodFrom;

  
  /**
   * @var \DateTime
   */
  var $periodTo;


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
  var $xmlGatewaySuffix = 'TransactionCore/xml';

 
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



  public function send() {
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

    $query = $xml->addChild('Query');
    $query->addAttribute('mode', $this->transaction->mode);
    $query->addAttribute('level', $this->level);
    $query->addAttribute('entity', $this->entity);
    $query->addAttribute('type', $this->type);

    if ($this->source) {
      $query->addAttribute('source', $this->source);
    }

    $user = $query->addChild('User');
    $user->addAttribute('login', $this->user->login);
    $user->addAttribute('pwd', $this->user->pwd);

    $identification = $query->addChild('Identification');
    $identification->addChild('UniqueID', $this->identification->uniqueid);


    if ($this->types) {
      $types =  $query->addChild('Types');
      $type = $types->addChild('Type');
      $type->addAttribute('code', $this->types->code);
    }

    $period = $query->addChild('Period');
    $period->addAttribute('from', $this->periodFrom->format("Y-m-d"));
    $period->addAttribute('to', $this->periodTo->format("Y-m-d"));

    return str_replace('<?xml version="1.1"?>', '<?xml version="1.1" encoding="UTF-8"?>', $xml->asXml());
  }


  private function parseXmlResponse($body) {
    $data = new \SimpleXMLElement($body); 
    $this->responseData     = $data;
  }



  public function setHttpClient($client) {
    $this->httpClient = $client;
  }

  public function getHttpClient() {
    return $this->httpClient;
  }
}
