<?php

namespace rc\Hooks\Functions;

interface FunctionStrategyInterface
{
    public function __invoke(\ArrayAccess $collection,array $arguments = null);

    public function name();
}