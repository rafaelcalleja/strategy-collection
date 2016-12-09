<?php

namespace rc\Hooks\Factory;

use rc\DefaultCollection;

class ArrayObject implements CollectionStrategyInterface
{
    public function create($collection)
    {
        return new DefaultCollection($collection);
    }
}
