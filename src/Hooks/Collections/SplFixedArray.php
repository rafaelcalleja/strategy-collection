<?php

namespace rc\Hooks\Collections;

class SplFixedArray implements CollectionStrategyInterface
{
    public function create($collection)
    {
        return \SplFixedArray::fromArray($collection);
    }
}
