<?php

namespace rc\Awares;

use rc\Awares\Collections\ArrayObject;
use rc\Awares\Collections\SplFixedArray;

use rc\BaseCollectionTestCase;
use rc\FactoryAwareCollection;

class FactoryAwareTest extends BaseCollectionTestCase  {

    public function testTypeAware(){

        $collection = new fixed([1,2]);
        $collection->setSize(3);
        $collection[2] = 3;

        $this->assertSame(3, $collection->getSize());
        $this->assertSame(3, count($collection));

        $concrete = new concrete([1,2,3]);
        $array = $concrete->getArrayCopy();
        $this->assertNotSame($array, $concrete);
    }
}

interface desingByContract extends ArrayObject {

}

interface fixedByContract extends SplFixedArray {

}

class concrete extends FactoryAwareCollection  implements desingByContract {

}

class fixed extends FactoryAwareCollection  implements fixedByContract {

}