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
        'account' => array()
      );
      $this->t = new Transaction(); 
      $this->t->setConfig($config);
      $this->assertEquals($config['endpointUrl'], $this->t->getEndpointUrl());
    }

}
