<?php

namespace rc\Hooks;

abstract class SingleImmutableCollection extends \ArrayObject implements \Countable, \IteratorAggregate, \ArrayAccess
{
    /**
     * @var string
     */
    private $className;

    public function __construct($className, $elements)
    {
        $this->className = $className;
        parent::__construct();

        foreach($elements as $index => $newval){
            $this->addItem($index, $newval);
        }
    }

    private function addItem($index, $newval){

        if (false === $newval instanceof $this->className ) {
            throw new \InvalidArgumentException(
                sprintf("Element must be an instance of (%s), instance of (%s) given",
                    $this->className,
                    is_object($newval) ? get_class($newval) : gettype($newval)
                ));
        }

        parent::offsetSet($index, $newval);
    }

    final public function offsetSet($index, $newval)
    {
        throw new \InvalidArgumentException('collection is immutable');
    }

    final public function offsetUnset($offset)
    {
        throw new \InvalidArgumentException('collection is immutable');
    }
}
