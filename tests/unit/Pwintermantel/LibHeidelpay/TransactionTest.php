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
    public function setInitialConfig() {
      $this->t = new Transaction(); 
      $this->t->setConfig($this->getConfig());
      $this->assertEquals($this->getConfig()['endpointUrl'], $this->t->endpointUrl);
      $this->assertEquals('', $this->t->account->holder);
    }


    /**
     * @test
     */
    public function updateConfig() {
      $this->t = new Transaction(); 
      $this->t->setConfig($this->getConfig());
      $this->t->setConfig(['account' => ['holder' => 'foo']]);
      $this->assertEquals('foo', $this->t->account->holder);
    }


     /**
     * @test
     */
    public function collectParams() {
      $this->t = new Transaction(); 
      $this->t->setConfig($this->getConfig());
      $this->assertEquals(['ACCOUNT.HOLDER' => ''], $this->t->collectParams());
    }


    private function getConfig() {
      return [
        'endpointUrl' => 'http:/foo',
        'account'     => ['holder' => '']
      ];
    } 
}



