<?php

namespace rc\Hooks\Invariants;

use rc\AbstractFactoryCollection;

class MaxElements implements PostConditionStrategyInterface{

    public function __invoke(AbstractFactoryCollection $collection)
    {
        if ( count($collection) > 3 ){
            throw new \InvalidArgumentException('Max elementes is 3');
        }
    }
}

