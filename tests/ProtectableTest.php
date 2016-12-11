<?php

namespace rc;

use rc\Hooks\ConfigurationInterface;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\HasExternalPort;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

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

class simple extends AbstractFactoryCollection {

    /**
     * @return PostConditionStrategyInterface[]
     */
    function getInvariants()
    {
        return [
            new MaxElements(),
            new MinElements()
        ];
    }

    /**
     * @return FunctionStrategyInterface[]
     */
    function getFunctions()
    {
        return [
            new GetSize(),
            new Contains(),
        ];
    }

    /**
     * @return CollectionInterface
     */
    function getCollection(array $elements = [])
    {
        return new DefaultCollection($elements);
    }
}

class success extends DomainCollectionFactory implements CompanyInvitationInterface {

}


class anotherSuccess extends DomainCollectionFactory implements ProtectableInterface {

    const EXAMPLE_VAR = 'example_var2';
}

class exception extends DomainCollectionFactory implements ProtectableInterface {

}

