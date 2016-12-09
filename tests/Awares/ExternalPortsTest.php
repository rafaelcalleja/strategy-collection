<?php

namespace rc\Awares;

use rc\BaseCollectionTestCase;
use rc\ExternalPortInterface;
use rc\FactoryAwareCollection;

class ExternalPortsTest extends \PHPUnit_Framework_TestCase {

    public function testSuccessExternalInterface()
    {
        $collection = new success([1,2]);
        $this->assertCount(2, $collection);

        $collection = new anotherSuccess([1,2]);
        $this->assertCount(2, $collection);
    }

    /**
     * @expectedException \InvalidArgumentException
    */
    public function testExceptionExternalInterface()
    {
        $collection = new exception([1,2]);
    }
}


interface RequiredExternalInterface extends
    \rc\Awares\Collections\ArrayObject,
    \rc\Awares\Invariants\HasExternalPort,
    ExternalPortInterface
{
}

interface GuardExampleInterface extends
    RequiredExternalInterface
{
    const EXAMPLE_VAR = 'example_var';
}


class success extends FactoryAwareCollection implements GuardExampleInterface {

}


class exception extends FactoryAwareCollection implements RequiredExternalInterface {

}

class anotherSuccess extends FactoryAwareCollection implements RequiredExternalInterface {
    const EXAMPLE_VAR = 'example_var2';
}

