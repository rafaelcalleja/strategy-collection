<?php

namespace rc\Hooks\Invariants;

use rc\CollectionContext;

interface PostConditionStrategyInterface
{
    public function __invoke(CollectionContext $collection);
}