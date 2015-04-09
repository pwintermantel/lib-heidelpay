<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Frontend extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * @var boolean 
   */
  var $enabled = true;


  /**
   * @var boolean 
   */
  var $language_selector= false;


  /**
   * @var boolean 
   */
  var $language = 'de';

  /**
   * @var boolean 
   */
  var $popup = true;


  /**
   * @var string 
   */
  var $shop_name = '';


  /**
   * @var string
   */
  var $mode = 'DEFAULT';
  

  /**
   * @var string
   */
  var $response_url;


  /**
   * @var string
   */
  var $redirect_url;


  /**
   * @var string
   */
  var $css_path;


  /**
   * @var int
   */
  var $redirect_time = 0;

}
