<?php
namespace Pwintermantel\LibHeidelpay;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Transaction {

  use Behavior\Configurable;

  /**
   * @var string
   */
  private $endpointUrl = null;

  /**
   * @var Transaction\Parameters\Account
   */
  private $account = null;


  /**
   * @param array $config Configuration Array
   * @return void
   **/
  public function __construct($config = null) {
    if (is_array($config)) {
      $this->setConfig($config); 
    }
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


  public function setAccount(Transaction\Parameters\Account $account) {
   $this->account = $account;
  } 
}
