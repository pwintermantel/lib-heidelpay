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
      $p =  $this->t->collectParams();
      $this->assertArrayHasKey('ADDRESS.STREET', $p);
      $this->assertArrayHasKey('ACCOUNT.HOLDER', $p);
      $this->assertArrayHasKey('CONTACT.EMAIL', $p);
      $this->assertArrayHasKey('FRONTEND.ENABLED', $p);
      $this->assertArrayHasKey('IDENTIFICATION.UNIQUEID', $p);
      $this->assertArrayHasKey('NAME.FAMILY', $p);
      $this->assertArrayHasKey('PAYMENT.CODE', $p);
      $this->assertArrayHasKey('SECURITY.SENDER', $p);
      $this->assertArrayHasKey('USER.LOGIN', $p);
      $this->assertArrayHasKey('USER.PASSWORD', $p);
      $this->assertArrayHasKey('TRANSACTION.CHANNEL', $p);
    }


    /**
     * @test
     */
    public function post() {
      
    }


    private function getConfig() {
      return [
        'endpointUrl' => 'http:/foo',
        'account'     => ['holder' => ''],
        'address'     => ['street' => ''],
        'contact'     => ['email' => ''],
        'frontend'    => ['enabled' => true],
        'identification' => ['uniqueid' => 'foo-1'],
        'name'        => ['family' => ''],
        'payment'     => ['code' => 'CC.RG'],
        'security'    => ['sender' => '31HA07BC8124AD82A9E96D9A35FAFD2A'],
        'user'        => ['login' => '31ha07bc8124ad82a9e96d486d19edaa', 'password' => 'password'],
        'transaction' => ['channel' => '31HA07BC81A71E2A47DA94B6ADC524D8'],
      ];
    } 
}



