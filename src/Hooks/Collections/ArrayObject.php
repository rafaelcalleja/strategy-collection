<?php

namespace rc\Hooks\Collections;

class ArrayObject implements CollectionStrategyInterface
{
    public function create($collection)
    {
        return new \ArrayObject($collection);
    }
}
