<?php

namespace rc\Hooks\Functions;

use rc\CollectionInterface;

interface FunctionStrategyInterface
{
    public function __invoke(CollectionInterface $collection,array $arguments = null);

    public function name();
}