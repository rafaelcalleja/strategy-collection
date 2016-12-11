<?php

namespace rc\Config;

use rc\DefaultCollection;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\HasExternalPort;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;


class Simple extends ConfigurationBuilder
{
    protected function init()
    {
        $this
            ->setCollection(new DefaultCollection($this->elements))
            ->addInvariant(new MaxElements())
            ->addFunction(new GetSize())
            ;
    }
}
