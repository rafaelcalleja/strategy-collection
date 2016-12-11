<?php

namespace rc\Hooks\Invariants;

use rc\AbstractFactoryCollection;

interface PostConditionStrategyInterface
{
    public function __invoke(AbstractFactoryCollection $collection);
}