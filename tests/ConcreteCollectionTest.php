<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\HookInterface;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;

class ConcreateCollectionTest extends \PHPUnit_Framework_TestCase {

    public function setUp(){

    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMaxElements(){

        $collection = new concrete([
            1,2,3,4
        ]);
    }

    public function testSize(){

        $collection = new concrete([
            1,2,3
        ]);

        $this->assertSame(3, $collection->getSize());
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testMinElements(){

        $collection = new concrete([]);
    }

    public function testContains(){

        $collection = new concrete([1,2]);
        $this->assertTrue($collection->contains(2));
        $this->assertFalse($collection->contains(3));
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testUnknown(){

        $collection = new concrete([1]);
        $collection->unknown();
    }

}

class concrete extends ArrayObjectCollection {

    public function  __construct(array $elements, HookInterface $hooks = null)
    {
        $hooks = new Configuration(
            [
                new MaxElements(),
                new MinElements()
            ],
            [
                new GetSize(),
                new Contains()
            ]
        );

        parent::__construct($elements, $hooks);
    }

}