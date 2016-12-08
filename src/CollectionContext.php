<?php

namespace rc;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\HookInterface;

/**
 * @mixin GetSize
 * @mixin Contains
 */
abstract class CollectionContext implements \ArrayAccess{

    /**
     * @var \ArrayAccess
     */
    private $collection;

    /**
     * @var HookInterface
     */
    private $hooks;

    /**
     * @param \ArrayAccess $collection
     * @param HookInterface $hooks
     */
    public function __construct(\ArrayAccess $collection, HookInterface $hooks)
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
        foreach($this->hooks->functionHooks() as $hook){
            if ( $hook->name() === $name) {
                return $hook($this->collection, $arguments);
            }
        }

        throw new \BadMethodCallException("Method $name doesn't exists");
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
            $hook($this->collection);
        }
    }
}