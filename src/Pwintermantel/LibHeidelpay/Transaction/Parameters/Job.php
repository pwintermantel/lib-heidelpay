<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Job extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var string 
   */
  var $name;
 
  /**
   * @var string 
   */
  var $action;
  
  /**
   * @var string 
   */
  var $start;

  /**
   * @var string 
   */
  var $end;


  /**
   * @var string
   */
  var $execution_dayofmonth; 

  /**
   * @var string
   */
  var $execution_hour; 
}
