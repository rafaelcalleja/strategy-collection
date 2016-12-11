<?php

namespace rc;

use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

class ConfigurationBuilder implements ConfigurationBuilderInterface
{
    private $invariants = [];

    private $functions = [];

    private $collection;

    public static function create()
    {
        return new static();
    }

    /**
     * @param array $elements
     */
    public function build()
    {
        return new Configuration(
                $this->collection,
                $this->invariants,
                $this->functions
        );
    }

    public function setCollection(CollectionInterface $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    public function addInvariant(PostConditionStrategyInterface $invariant)
    {
        $this->invariants[] = $invariant;
        return $this;
    }

    public function addFunction(FunctionStrategyInterface $function)
    {
        $this->functions[] = $function;
        return $this;
    }
}
