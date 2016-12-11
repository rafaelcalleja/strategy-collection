<?php

namespace rc\Config;

use rc\CollectionInterface;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\ConfigurationInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

class Configuration implements ConfigurationInterface{

    /**
     * @var array
     */
    private $postHooks;

    /**
     * @var array
     */
    private $functionHooks;

    /**
     * @var CollectionInterface
     */
    private $collection;

    public function __construct(CollectionInterface $collection, array $postHooks, array $functionHooks)
    {
        $this->collection = $collection;
        $this->setPostHooks($postHooks);
        $this->setFunctionHooks($functionHooks);
    }

    /**
     * @return CollectionInterface
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @return PostConditionStrategyInterface[]
     */
    public function postHooks()
    {
        return $this->postHooks;
    }

    /**
     * @return FunctionStrategyInterface[]
     */
    public function functionHooks()
    {
        return $this->functionHooks;
    }

    /**
     * @param array $postHooks
     */
    private function setPostHooks(array $postHooks)
    {
        foreach($postHooks as $hook){
            if (false === $hook instanceof PostConditionStrategyInterface){
                throw new \InvalidArgumentException(
                    sprintf("Hook must be type of PostConditionStrategyInterface but type (%s) given",
                        get_class($hook)
                    )
                );
            }
        }
        $this->postHooks = $postHooks;
    }

    /**
     * @param array $functionHooks
     */
    private function setFunctionHooks(array $functionHooks)
    {
        foreach($functionHooks as $hook){
            if (false === $hook instanceof FunctionStrategyInterface){
                throw new \InvalidArgumentException(
                    sprintf("Hook must be type of FunctionStrategyInterface but type (%s) given",
                        get_class($hook)
                    )
                );
            }
        }
        $this->functionHooks = $functionHooks;
    }
}
