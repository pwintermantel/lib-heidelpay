<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Address extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var string 
   */
  var $street;
 

  /**
   * @var string 
   */
  var $zip;


  /**
   * @var string 
   */
  var $city;


  /**
   * @var string 
   */
  var $country;


  /**
   * @var string 
   */
  var $state;

}

