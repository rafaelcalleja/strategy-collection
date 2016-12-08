<?php

namespace rc\Hooks\Invariants;

class MaxElements implements PostConditionStrategyInterface{

    public function __invoke(\ArrayAccess $collection)
    {
        if ( count($collection) > 3 ){
            throw new \InvalidArgumentException('Max elementes is 3');
        }
    }
}

