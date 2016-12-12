<?php

namespace rc\Hooks\Invariants;

use rc\ContextInterface;

class MaxElements implements PostConditionStrategyInterface
{

    public function __invoke(ContextInterface $collection)
    {
        if (count($collection) > 3){
            throw new \InvalidArgumentException('Max elementes is 3');
        }
    }
}
