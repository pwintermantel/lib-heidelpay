<?php
namespace Pwintermantel\LibHeidelpay\Behavior;

trait Configurable {

  /**
   * @param array $config Configuration Array
   * @return void
   **/
  public function setConfig($config) {
    foreach ($config as $key => $val) {
      $orgVal = $val;

      if (is_array($val)) {
        if (null === $this->{$key}) {
          $className = "\\Pwintermantel\\LibHeidelpay\\Transaction\\Parameters\\" . ucfirst($key);
          $this->{$key} = new $className();
        } 
        $this->{$key}->setConfig($orgVal);
      } else {
        $this->{$key} = $val;
      }
    }
  }
}
