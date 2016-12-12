<?php

namespace rc\Config;

use rc\CollectionInterface;
use rc\Hooks\Functions\FunctionCollection;
use rc\Hooks\ConfigurationInterface;
use rc\Hooks\Invariants\PostConditionsCollection;

class Configuration implements ConfigurationInterface{

    /**
     * @var PostConditionsCollection
     */
    private $postHooks;

    /**
     * @var FunctionCollection
     */
    private $functionHooks;

    /**
     * @var CollectionInterface
     */
    private $collection;

    public function __construct(CollectionInterface $collection, PostConditionsCollection $postHooks, FunctionCollection $functionHooks)
    {
        $this->collection = $collection;
        $this->postHooks = $postHooks;
        $this->functionHooks = $functionHooks;
    }

    /**
     * @return CollectionInterface
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @return PostConditionsCollection
     */
    public function postHooks()
    {
        return $this->postHooks;
    }

    /**
     * @return FunctionCollection
     */
    public function functionHooks()
    {
        return $this->functionHooks;
    }
}
