<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Security extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var string 
   */
  var $sender;
}
