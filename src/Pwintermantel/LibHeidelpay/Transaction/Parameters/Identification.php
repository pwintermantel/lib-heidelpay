<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Identification extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var string 
   */
  var $referenceid;
 

  /**
   * @var string 
   */
  var $transactionid;

 
  /**
   * @var string 
   */
  var $uniqueid;

 
  /**
   * @var string 
   */
  var $shopperid;

 
  /**
   * @var string 
   */
  var $invoiceid;


  /**
   * @var string 
   */
  var $shortid;


}
