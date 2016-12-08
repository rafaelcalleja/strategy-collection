<?php

namespace rc\Hooks\Invariants;

interface PostConditionStrategyInterface
{
    public function __invoke(\ArrayAccess $collection);
}