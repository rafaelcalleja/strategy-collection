<?php

namespace rc\Config;

use rc\CollectionInterface;
use rc\Hooks\Functions\FunctionCollection;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Invariants\PostConditionsCollection;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

abstract class ConfigurationBuilder implements ConfigurationBuilderInterface
{
    /**
     * @var PostConditionsCollection
     */
    private $invariants = [];

    /**
     * @var FunctionCollection
     */
    private $functions = [];

    /**
     * @var CollectionInterface
     */
    private $collection;

    /**
     * @var array
     */
    private $elements;

    /**
     * @param array $elements
     * @return ConfigurationBuilder
     */
    public function __construct(array $elements = [])
    {
        $this->invariants = [];
        $this->functions = [];
        $this->elements = $elements;
    }

    abstract protected function init();

    public function build()
    {
        $this->init();

        return new Configuration(
                $this->collection,
                new PostConditionsCollection($this->invariants),
                new FunctionCollection($this->functions)
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

    protected function elements()
    {
        return $this->elements;
    }
}
