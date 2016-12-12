<?php

namespace rc;

use rc\Config\Configuration;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\ExecuteService;
use rc\Hooks\Functions\FunctionCollection;
use rc\Hooks\Functions\GetSize;
use rc\Hooks\Invariants\MaxElements;
use rc\Hooks\Invariants\MinElements;
use rc\Hooks\Invariants\PostConditionsCollection;

class ArrayObjectCollection extends CollectionContext {

    public  function __construct(array $elements)
    {
        parent::__construct(new Configuration(
                new DefaultCollection($elements),
                new PostConditionsCollection(
                    [
                        new MaxElements(),
                        new MinElements()
                    ]
                ),
                new FunctionCollection(
                    [
                        new GetSize(),
                        new Contains(),
                        new ExecuteService()
                    ]
                )
            )
        );
    }
}
