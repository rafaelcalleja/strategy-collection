<?php

namespace rc;

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


        //SUCESS COMPANY INVITATION
        $collection = new success([1,2]);
        $this->assertCount(2, $collection);

        $this->assertInstanceOf('rc\ProtectableInterface', $collection);
        $this->assertInstanceOf('rc\CompanyInvitationInterface', $collection);

        //SUCESS PROTECTABLE
        $collection = new anotherSuccess([1,2]);
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
}

//Sin modificar DomainAwareInterface
interface ProtectableInterface extends ExternalPortInterface
{
}

interface CompanyInvitationInterface extends
    ProtectableInterface
{
    const EXAMPLE_VAR = 'example_var';
}

//Esta seria Base DomainCollection
class ProtectedCollection extends CollectionContext {

    public  function __construct(array $elements)
    {
        parent::__construct(new Configuration(
                new DefaultCollection($elements),
                [
                    new MaxElements(),
                    new MinElements(),
                    new HasExternalPort()
                ],
                [
                    new GetSize(),
                    new Contains(),
                ]
            )
        );
    }
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

class success extends ProtectedCollection implements CompanyInvitationInterface {

    public function  __construct(array $elements)
    {
        parent::__construct($elements);
    }

}


class anotherSuccess extends ProtectedCollection implements ProtectableInterface {

    const EXAMPLE_VAR = 'example_var2';
    public function  __construct(array $elements)
    {
        parent::__construct($elements);
    }
}

class exception extends ProtectedCollection implements ProtectableInterface {

    public function  __construct(array $elements)
    {
        parent::__construct($elements);
    }

}

