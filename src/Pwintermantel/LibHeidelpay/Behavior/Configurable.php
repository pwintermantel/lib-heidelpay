<?php
namespace Pwintermantel\LibHeidelpay\Behavior;

trait Configurable {

  /**
   * @param array $config Configuration Array
   * @return void
   **/
  public function setConfig($config) {
    foreach ($config as $key => $val) {
      if (is_array($val)) {
        $className = "\\Pwintermantel\\LibHeidelpay\\Transaction\\Parameters\\" . $this->normalizeKey($key);
        $orgVal = $val;
        $val = new $className();
        $val->setConfig($orgVal);
      } 
      $this->{'set' . $this->normalizeKey($key)}($val);
    }
  }

  private function normalizeKey($key) {
     return ucfirst(strtolower(trim($key)));
  }
  
}
