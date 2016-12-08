<?php

namespace rc\Hooks\Functions;

/**
 * @method bool contains($element)
*/
class Contains implements FunctionStrategyInterface {

    public function __invoke(\ArrayAccess $collection, array $arguments = null)
    {
        list($entity) = $arguments;

        foreach ($collection as $each) {
            if ($entity === $each) {
                return true;
            }
        };

        return false;
    }

    public function name()
    {
        return 'contains';
    }
}

