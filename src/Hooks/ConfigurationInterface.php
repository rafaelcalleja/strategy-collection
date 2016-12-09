<?php

namespace rc\Hooks;

use rc\CollectionInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;
use rc\Hooks\Functions\FunctionStrategyInterface;

interface ConfigurationInterface
{
    /**
     * @return CollectionInterface
     */
    public function collection();

    /**
     * @return PostConditionStrategyInterface[]
     */
    public function postHooks();

    /**
     * @return FunctionStrategyInterface[]
     */
    public function functionHooks();
}