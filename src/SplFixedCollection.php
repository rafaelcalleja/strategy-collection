<?php

namespace rc;

class SplFixedCollection extends \SplFixedArray implements CollectionInterface
{
    public function __construct($elements)
    {
        parent::__construct(count($elements));
        foreach($elements as $key => $element){
            parent::offsetSet($key, $element);
        }
    }

    /**
     * {@inheritdoc]}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->toArray());
    }
}
