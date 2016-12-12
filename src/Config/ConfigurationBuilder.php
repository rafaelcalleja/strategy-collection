<?php

namespace rc\Config;

use rc\CollectionInterface;
use rc\Hooks\Functions\FunctionCollection;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Invariants\PostConditionsCollection;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

abstract class ConfigurationBuilder implements ConfigurationBuilderInterface
{
    private $invariants = [];

    private $functions = [];

    private $collection;

    /**
     * @var array
     */
    protected $elements;

    /**
     * @param array $elements
     * @return ConfigurationBuilder
     */
    public function __construct(array $elements = [])
    {
        $this->invariants = new PostConditionsCollection();
        $this->functions = new FunctionCollection();
        $this->elements = $elements;
    }

    abstract protected function init();

    public function build()
    {
        $this->init();

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
