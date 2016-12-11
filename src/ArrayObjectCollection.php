<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

class ArrayObjectCollection extends AbstractFactoryCollection {

    /**
     * @return PostConditionStrategyInterface[]
     */
    function getInvariants()
    {
        return [
            new MaxElements(),
            new MinElements(),
        ];
    }

    /**
     * @return FunctionStrategyInterface[]
     */
    function getFunctions()
    {
        return [
            new GetSize(),
            new Contains(),
        ];
    }

    /**
     * @return CollectionInterface
     */
    function getCollection(array $elements = [])
    {
        return new DefaultCollection($elements);
    }
}
