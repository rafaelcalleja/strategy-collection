<?php

namespace rc\Awares;

use rc\ExternalPortInterface;
use rc\FactoryAwareCollection;

class ExternalPortsTest extends \PHPUnit_Framework_TestCase {

    public function testSuccessExternalInterface()
    {
        //SIMPLE
        $simple = new simple([1,2]);
        $this->assertInstanceOf('rc\Awares\DomainAwareInterface', $simple);
        $this->assertNotInstanceOf('rc\Awares\ProtectabeInterface', $simple);
        $this->assertNotInstanceOf('rc\Awares\CompanyInvitationInterface', $simple);


        //SUCESS COMPANY INVITATION
        $collection = new success([1,2]);
        $this->assertCount(2, $collection);

        $this->assertInstanceOf('rc\Awares\DomainAwareInterface', $collection);
        $this->assertInstanceOf('rc\Awares\Invariants\HasExternalPort', $collection);
        $this->assertInstanceOf('rc\Awares\ProtectabeInterface', $collection);
        $this->assertInstanceOf('rc\Awares\CompanyInvitationInterface', $collection);

        //SUCESS PROTECTABLE
        $collection = new anotherSuccess([1,2]);
        $this->assertCount(2, $collection);

        $this->assertInstanceOf('rc\Awares\DomainAwareInterface', $collection);
        $this->assertInstanceOf('rc\Awares\Invariants\HasExternalPort', $collection);
        $this->assertInstanceOf('rc\Awares\ProtectabeInterface', $collection);

        $this->assertNotInstanceOf('rc\Awares\CompanyInvitationInterface', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
    */
    public function testExceptionExternalInterface()
    {
        $collection = new exception([1,2]);
    }
}

//Sin modificar DomainAwareInterface
interface ProtectabeInterface extends
    \rc\Awares\Collections\ArrayObject,
    \rc\Awares\Invariants\HasExternalPort,
    ExternalPortInterface
{
}

interface CompanyInvitationInterface extends
    ProtectabeInterface
{
    const EXAMPLE_VAR = 'example_var';
}

class simple extends FactoryAwareCollection implements \rc\Awares\Collections\ArrayObject  {

}

class success extends FactoryAwareCollection implements CompanyInvitationInterface {

}


class exception extends FactoryAwareCollection implements ProtectabeInterface {

}

class anotherSuccess extends FactoryAwareCollection implements ProtectabeInterface {
    const EXAMPLE_VAR = 'example_var2';
}

