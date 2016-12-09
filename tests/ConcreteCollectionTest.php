<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\HookInterface;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;

class ConcreateCollectionTest extends BaseCollectionTestCase {

    public function setUp(){

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