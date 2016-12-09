<?php

namespace rc\Hooks\Invariants;

use rc\CollectionContext;

class MinElements implements PostConditionStrategyInterface{

    public function __invoke(CollectionContext $collection)
    {
        if ( count($collection) < 1 ){
            throw new \InvalidArgumentException('Min elementes is 0');
        }
    }
}

