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
  private $endpointUrl = null;

  /**
   * @var Transaction\Parameters\Account
   */
  private $account = null;

  
  private $httpClient = null;

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


  /**
   * @param string $url
   * @return void
   */
  public function setEndpointUrl($url) {
    $this->endpointUrl = $url;
  }
 

  /**
   * @return string $url
   */
  public function getEndpointUrl() {
    return $this->endpointUrl;
  }


  /**
   * @param Transaction\Parameters\Account $account
   * @retur void
   */
  public function setAccount(Transaction\Parameters\Account $account) {
   $this->account = $account;
  } 


  /**
   * @return Transaction\Parameters\Account 
   */
  public function getAccount() {
    return $this->account;
  } 
}
