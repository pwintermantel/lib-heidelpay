<?php
namespace Pwintermantel\LibHeidelpay\Transaction\Parameters;

/**
 * @author Philipp Wintermantel <philipp@wintermantel.org>
 *
 */

class Transaction extends AbstractParameters implements ParametersInterface {

  use \Pwintermantel\LibHeidelpay\Behavior\Postable;
  use \Pwintermantel\LibHeidelpay\Behavior\Configurable;
 
  /**
   * Channel for CC, OT Sofort, DC, DD, PayPal
   **/ 
  const CHANNEL_DEFAULT = '31HA07BC81A71E2A47DA94B6ADC524D8';
  
  /**
   * Channel for Giropay
   **/ 
  const CHANNEL_GIROPAY = '31HA07BC81A71E2A47DA662C5EDD1112';

  /**
   * Channel for iDeal
   **/ 
  const CHANNEL_IDEAL= '31HA07BC81A71E2A47DA804F6CABDC59';


  /**
   * Mode Live
   */
  const MODE_LIVE = 'LIVE';


  /**
   * Mode test_integrator
   */
  const MODE_INTEGRATOR_TEST = 'INTEGRATOR_TEST';

  /**
   * Mode test_connector
   */
  const MODE_CONNECTOR_TEST = 'CONNECTOR_TEST';

  /**
   * @var string 
   */
  var $channel;


  /**
   * @var string 
   */
  var $mode;


}
