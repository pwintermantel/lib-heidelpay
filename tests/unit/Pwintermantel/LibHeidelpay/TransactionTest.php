<?php
namespace Pwintermantel\LibHeidelpay;

class TransactionTest extends \Codeception\TestCase\Test
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before() {
    }

    protected function _after() {
    }

    /**
     * @test
     */
    public function setConfig() {
      $config = array(
        'endpointUrl' => 'http:/foo',
        'account' => array('holder' => '')
      );
      $this->t = new Transaction(); 
      $this->t->setConfig($config);
      $this->assertEquals($config['endpointUrl'], $this->t->getEndpointUrl());
    }


     /**
     * @test
     */
    public function collectParams() {
      $config = array(
        'endpointUrl' => 'http:/foo',
        'account' => array('holder' => '')
      );
      $this->t = new Transaction(); 
      $this->t->setConfig($config);
      $this->assertEquals(['ACCOUNT.HOLDER' => ''], $this->t->collectParams());
    }

}
