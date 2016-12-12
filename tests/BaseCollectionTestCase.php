<?php

namespace rc;

abstract class BaseCollectionTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMaxElements() {

        $collection = new concrete([
            1, 2, 3, 4,
        ]);
    }

    public function testSize() {

        $collection = new concrete([
            1, 2, 3,
        ]);

        $this->assertSame(3, $collection->getSize());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMinElements() {

        $collection = new concrete([]);
    }

    public function testContains() {

        $collection = new concrete([1, 2]);
        $this->assertTrue($collection->contains(2));
        $this->assertFalse($collection->contains(3));
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testUnknown() {

        $collection = new concrete([1]);
        $collection->unknown();
    }

    public function testExecuteService() {
        $collection = new concrete(['service']);
        $actual = $collection->executeService('helloWorld');

        $this->assertSame('helloWorld', $actual);
    }

}
