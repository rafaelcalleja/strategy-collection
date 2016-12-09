<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\HookInterface;

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
     * @var HookInterface
     */
    private $hooks;

    /**
     * @param CollectionInterface $collection
     * @param HookInterface $hooks
     */
    public function __construct($collection, HookInterface $hooks)
    {
        $this->collection = $collection;
        $this->hooks = $hooks;

        $this->executePostsHooks($this->hooks);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        foreach ($this->hooks->functionHooks() as $hook) {
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
        $this->executePostsHooks($this->hooks);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        $this->collection->offsetUnset($offset);
    }

    /**
     * @param HookInterface $hooks
     */
    private function executePostsHooks(HookInterface $hooks)
    {
        foreach ($hooks->postHooks() as $hook) {
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
        if ($this->collection instanceof \IteratorAggregate) {
            return $this->collection->getIterator();
        }

        return new \ArrayIterator($this->toArray());
    }

    private function toArray()
    {
        if (method_exists($this->collection, 'getArrayCopy')) {
            return $this->collection->getArrayCopy();
        }

        if (method_exists($this->collection, 'toArray')) {
            return $this->collection->toArray();
        }

        if ($this->collection instanceof \Traversable) {
            $array = [];
            foreach ($this->collection as $element) {
                $array[] = $element;
            }
            return $array;
        }

        throw new \InvalidArgumentException('Invalid Iterator');
    }
}
