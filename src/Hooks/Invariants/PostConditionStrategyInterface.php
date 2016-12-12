<?php

namespace rc\Hooks\Invariants;

use rc\ContextInterface;

interface PostConditionStrategyInterface
{
    public function __invoke(ContextInterface $collection);
}