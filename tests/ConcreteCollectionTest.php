<?php

namespace rc;

class ConcreateCollectionTest extends BaseCollectionTestCase {

    public function setUp(){

    }

}

class concrete extends ArrayObjectCollection {

    public function  __construct(array $elements)
    {
        parent::__construct($elements);
    }

}