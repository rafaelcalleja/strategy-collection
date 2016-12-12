<?php

namespace rc\Hooks\Invariants;

use rc\ContextInterface;

class MinElements implements PostConditionStrategyInterface
{
    public function __invoke(ContextInterface $collection)
    {
        if (count($collection) < 1){
            throw new \InvalidArgumentException('Min elementes is 0');
        }
    }
}
