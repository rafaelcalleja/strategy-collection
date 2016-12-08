<?php

namespace rc;

use rc\Hooks\HookInterface;

class ArrayObjectCollection extends CollectionContext {

    public  function __construct(array $elements, HookInterface $hooks = null)
    {
        parent::__construct(
            new \ArrayObject($elements),
            $hooks
        );
    }

}
