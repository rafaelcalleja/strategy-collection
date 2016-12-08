<?php

namespace rc\Hooks\Functions;

/**
 * @method int getSize 
*/
class GetSize implements FunctionStrategyInterface {

    public function __invoke(\ArrayAccess $collection, array $arguments = null)
    {
        return count($collection);
    }

    public function name()
    {
        return 'getSize';
    }
}

