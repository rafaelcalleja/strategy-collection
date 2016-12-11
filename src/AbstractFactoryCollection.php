<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\FunctionStrategyInterface;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\ConfigurationInterface;
use rc\Hooks\Invariants\PostConditionStrategyInterface;

/**
 * @mixin GetSize
 * @mixin Contains
 */
abstract class AbstractFactoryCollection implements CollectionInterface, \Iterator
{
    /**
     * @var CollectionInterface | \Iterator
     */
    private $collection;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @var array
     */
    private $elements;

    public function __construct(array $elements = [])
    {
        $this->elements = $elements;
        $this->initConfig($elements);
    }

    /**
     * @return FunctionStrategyInterface[]
     */
    abstract function getFunctions();

    /**
     * @return PostConditionStrategyInterface[]
     */
    abstract function getInvariants();

    /**
     * @return CollectionInterface
     */
    abstract function getCollection(array $elements = []);

    /**
     * @return void
     */
    private function setConfiguration(array $elements = [])
    {
        $this->configuration = new Configuration(
            $this->getCollection($elements),
            $this->getInvariants(),
            $this->getFunctions()
        );
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        foreach ($this->configuration->functionHooks() as $hook) {
            if ($hook->name() === $name) {
                return $hook($this->collection, $arguments);
            }
        }

        if (true === is_callable([$this->collection, $name])) {
            return call_user_func_array([$this->collection, $name], $arguments);
        }

        throw new \BadMethodCallException("Method $name doesn't exists on collection type of ". get_class($this->collection));
    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return $this->collection->offsetExists($offset);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->collection->offsetGet($offset);
    }

    /**
     * {@inheritdoc}
     */
    final public function offsetSet($offset, $value)
    {
        $this->collection->offsetSet($offset, $value);
        $this->executePostsHooks();
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->collection->offsetUnset($offset);
    }

    /**
     *
     */
    private function executePostsHooks()
    {
        foreach ($this->configuration->postHooks() as $hook) {
            $hook($this);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function current()
    {
        return $this->collection->current();
    }

    /**
     * {@inheritdoc}
     */
    public function next()
    {
        $this->collection->next();
    }

    /**
     * {@inheritdoc}
     */
    public function key()
    {
        return $this->collection->key();
    }

    /**
     * {@inheritdoc}
     */
    public function valid()
    {
        return $this->collection->valid();
    }

    /**
     * {@inheritdoc}
     */
    public function rewind()
    {
        $this->collection->rewind();
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return $this->collection->count();
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        return $this->collection->getIterator();
    }

    /**
     * @return void
     */
    private function initConfig(array $elements = [])
    {
        $this->setConfiguration($elements);
        $this->collection = $this->configuration->collection();
        $this->executePostsHooks();
    }
}
