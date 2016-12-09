<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\ConfigurationInterface;

/**
 * @mixin GetSize
 * @mixin Contains
 */
abstract class CollectionContext implements CollectionInterface, \IteratorAggregate
{
    /**
     * @var \ArrayAccess
     */
    private $collection;

    /**
     * @var ConfigurationInterface
     */
    private $configuration;

    /**
     * @param CollectionInterface $collection
     * @param ConfigurationInterface $configuration
     */
    public function __construct(ConfigurationInterface $configuration)
    {
        $this->configuration = $configuration;

        $this->collection = $configuration->collection();
        $this->executePostsHooks();
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
    public function offsetSet($offset, $value)
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
        $this->collection->current();
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
        return $this->collection->rewind();
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
}
