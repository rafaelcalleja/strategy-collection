<?php

namespace rc;

use rc\Config\Configuration;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\HasExternalPort;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;

class ExternalPortsTest extends \PHPUnit_Framework_TestCase {

    public function testSuccessExternalInterface()
    {
        //SIMPLE
        $simple = new simple([1,2]);
        $this->assertNotInstanceOf('rc\ProtectableInterface', $simple);
        $this->assertNotInstanceOf('rc\CompanyInvitationInterface', $simple);

        //Builder
        $builder = new builder([1,2]);
        $this->assertNotInstanceOf('rc\ProtectableInterface', $builder);
        $this->assertNotInstanceOf('rc\CompanyInvitationInterface', $builder);

        //SUCESS COMPANY INVITATION
        $collection = new CompanyInvitationCollection([1,2]);
        $this->assertCount(2, $collection);

        $this->assertInstanceOf('rc\ProtectableInterface', $collection);
        $this->assertInstanceOf('rc\CompanyInvitationInterface', $collection);

        //SUCESS PROTECTABLE
        $collection = new CompanyEmployeeCollection([1,2]);
        $this->assertCount(2, $collection);
        $this->assertInstanceOf('rc\ProtectableInterface', $collection);
        $this->assertNotInstanceOf('rc\CompanyInvitationInterface', $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
    */
    public function testExceptionExternalInterface()
    {
        $collection = new exception([1,2]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testExceptionExternalInterfaceOcp()
    {
        $collection = new exceptionOcp([1,2]);
    }
}

//Sin modificar DomainAwareInterface
interface ProtectableInterface extends ExternalPortInterface
{
    public function checkInvariants();
}

interface CompanyInvitationInterface extends
    ProtectableInterface
{
    const EXAMPLE_VAR = 'example_var';
}

//Esta seria Base DomainCollection
class ProtectedCollection extends DomainCollection {

}

class simple extends CollectionContext {

    public  function __construct(array $elements)
    {
        parent::__construct(new Configuration(
                new DefaultCollection($elements),
                [
                    new MaxElements(),
                    new MinElements()
                ],
                [
                    new GetSize(),
                    new Contains(),
                ]
            )
        );
    }
}

class builder extends BuilderCollection {

    public  function __construct(array $elements)
    {
        parent::__construct(new \rc\Config\Simple($elements));
    }
}

class CompanyInvitationCollection extends ProtectedCollection implements CompanyInvitationInterface {

    public function checkInvariants()
    {
        // TODO: Implement checkInvariants() method.
    }
}


class CompanyEmployeeCollection extends ProtectedCollection implements ProtectableInterface {

    const EXAMPLE_VAR = 'Domain\\XXX';

    public function checkInvariants()
    {
        // TODO: Implement checkInvariants() method.
    }
}

class exception extends ProtectedCollection implements ProtectableInterface {

    public function checkInvariants()
    {
        // TODO: Implement checkInvariants() method.
    }
}

class exceptionOcp extends BuilderCollection implements ProtectableInterface {

    public  function __construct(array $elements)
    {
        parent::__construct(
            (new \rc\Config\Simple($elements))
                ->addInvariant(new HasExternalPort())

        );
    }

    public function checkInvariants()
    {
        // TODO: Implement checkInvariants() method.
    }
}

