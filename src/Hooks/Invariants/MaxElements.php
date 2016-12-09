<?php

namespace rc\Hooks\Invariants;

use rc\CollectionContext;

class MaxElements implements PostConditionStrategyInterface{

    public function __invoke(CollectionContext $collection)
    {
        if ( count($collection) > 3 ){
            throw new \InvalidArgumentException('Max elementes is 3');
        }
    }
}

