<?php

namespace rc\Hooks;

use rc\Hooks\Invariants\PostConditionStrategyInterface;
use rc\Hooks\Functions\FunctionStrategyInterface;

interface HookInterface
{
    /**
     * @return PostConditionStrategyInterface[]
     */
    public function postHooks();

    /**
     * @return FunctionStrategyInterface[]
     */
    public function functionHooks();
}