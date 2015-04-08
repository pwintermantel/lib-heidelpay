<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Account extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var string 
   */
  private $holder;
 
  /*
   * @param string $holder
   */
  public function setHolder($holder) {
    $this->holder = $holder;
  } 

  /*
   * @return string $holder
   */
  public function getHolder() {
    return $this->holder;
  } 
}
