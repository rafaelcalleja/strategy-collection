<?php

namespace rc\Hooks\Invariants;

class MinElements implements PostConditionStrategyInterface{

    public function __invoke(\ArrayAccess $collection)
    {
        if ( count($collection) < 1 ){
            throw new \InvalidArgumentException('Min elementes is 0');
        }
    }
}

