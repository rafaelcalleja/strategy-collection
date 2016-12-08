<?php

namespace rc;

use rc\Hooks\HookInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

class Configuration implements HookInterface{

    /**
     * @var array
     */
    private $postHooks;

    /**
     * @var array
     */
    private $functionHooks;

    public function __construct(array $postHooks, array $functionHooks)
    {
        $this->postHooks = $postHooks;
        $this->functionHooks = $functionHooks;
    }

    /**
     * @return PostConditionStrategyInterface
     */
    public function postHooks()
    {
        return $this->postHooks;
    }

    /**
     * @return [] FunctionStrategyInterface
     */
    public function functionHooks()
    {
        return $this->functionHooks;
    }
}
