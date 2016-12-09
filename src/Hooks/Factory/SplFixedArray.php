<?php

namespace rc\Hooks\Factory;

use rc\SplFixedCollection;

class SplFixedArray implements CollectionStrategyInterface
{
    public function create($collection)
    {
        return new SplFixedCollection($collection);
    }
}
