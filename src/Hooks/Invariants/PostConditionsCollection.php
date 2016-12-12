<?php

namespace rc\Hooks\Invariants;

final class PostConditionsCollection extends \ArrayObject implements \Countable, \IteratorAggregate, \ArrayAccess
{
    public function __construct(array $elements =[])
    {
        parent::__construct();

        foreach($elements as $index => $newval){
            $this->offsetSet($index, $newval);
        }
    }

    final public function offsetSet($index, $newval)
    {
        if (false === $newval instanceof PostConditionStrategyInterface ) {
            throw new \InvalidArgumentException(
                sprintf("Element must be an instance of (PostConditionStrategyInterface), instance of (%s) given",
                    is_object($newval) ? get_class($newval) : gettype($newval)
                ));
        }

        parent::offsetSet($index, $newval);
    }
}
