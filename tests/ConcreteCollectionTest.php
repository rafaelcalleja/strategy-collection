<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;

class ConcreateCollectionTest extends BaseCollectionTestCase {

    public function setUp(){

    }

}

/**
 * @mixin GetSize
 * @mixin Contains
 */
class concrete extends ArrayObjectCollection {

    public function  __construct(array $elements)
    {
        parent::__construct($elements);
    }

}