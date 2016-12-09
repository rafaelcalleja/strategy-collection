<?php

namespace rc\Hooks\Invariants;

use rc\CollectionContext;
use rc\ExternalPortInterface;

class HasExternalPort implements PostConditionStrategyInterface
{
    public function __invoke(CollectionContext $collection)
    {
        if (false === $collection instanceof ExternalPortInterface) {
            throw new \InvalidArgumentException(sprintf("collection (%s) must implement ExternalPortInterface", get_class($collection)));
        }

        $constantName = sprintf("%s::%s", get_class($collection), 'EXAMPLE_VAR');

        if (false === defined($constantName)) {
            throw new \InvalidArgumentException(
                "Undefined constant ({$constantName})"
            );
        }
    }
}
