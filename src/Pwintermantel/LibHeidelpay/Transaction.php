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
   * @var \GuzzleHttp\Client
   */
  var $httpClient = null;

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
    $this->collectParams();
  }


  public function setHttpClient($client) {
    $this->httpClient = $client;
  }

  public function getHttpClient() {
    return $this->httpClient;
  }
}
