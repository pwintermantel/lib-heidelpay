<?php
namespace Pwintermantel\LibHeidelpay\Behavior;

trait Postable {
  public function getParams() {
    if (isset($this->postPrefix)) {
      $prefix = $this->postPrefix;
    } else {
      $class = get_class($this);
      $classParts = explode('\\', $class);
      $prefix = end($classParts);
    }

    $glue   = '.';
    $out    = [];
    foreach (get_object_vars($this) as $key => $val) {
      if (null !== $val) {
        $out[strtoupper($prefix) . $glue . strtoupper($key)] = $val;
      }
    }
    return $out;
  }

  public function collectParams() {
    $out = [];
    foreach (get_object_vars($this) as $key => $val) {
      if (is_object($val) && method_exists($val, 'getParams')) {
        $params = $val->getParams(); 
        $out = array_merge($out, $params);
      } 
    }
    return $out; 
  }
}
