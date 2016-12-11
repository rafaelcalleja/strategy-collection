<?php

namespace rc\Config;

use rc\CollectionInterface;
use rc\Hooks\ConfigurationInterface;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

interface ConfigurationBuilderInterface
{
    /**
     * @param CollectionInterface $collection
     * @return ConfigurationBuilderInterface
     */
    public function setCollection(CollectionInterface $collection);

    /**
     * @param PostConditionStrategyInterface $invariant
     * @return ConfigurationBuilderInterface
     */
    public function addInvariant(PostConditionStrategyInterface $invariant);

    /**
     * @param FunctionStrategyInterface $function
     * @return ConfigurationBuilderInterface
     */
    public function addFunction(FunctionStrategyInterface $function);

    /**
     * @return ConfigurationInterface
     */
    public function build();
}