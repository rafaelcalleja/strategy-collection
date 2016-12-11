<?php

namespace rc;

use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\HasExternalPort;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;

abstract class DomainCollection extends CollectionContext
{
    public function __construct(array $elements = [])
    {
        $configuration = ConfigurationBuilder::create()
            ->setCollection(new DefaultCollection($elements))
            ->addInvariant(new MaxElements())
            ->addInvariant(new MinElements())
            ->addInvariant(new HasExternalPort())
            ->addFunction(new GetSize())
            ->addFunction(new Contains())
        ;

        parent::__construct(
            $configuration->build()
        );
    }
}
