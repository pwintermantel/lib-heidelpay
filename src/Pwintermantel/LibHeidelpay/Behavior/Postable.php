<?php
namespace Pwintermantel\LibHeidelpay\Behavior;

trait Postable {
  public function getParams() {
    $prefix = strtoupper(isset($this->postPrefix) ? $this->postPrefix : end(explode('\\', get_class($this))));
    $glue   = '.';
    $out    = [];
    foreach (get_object_vars($this) as $key => $val) {
        if (null !== $val) {
          $out[$prefix . $glue . strtoupper($key)] = $val;
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
