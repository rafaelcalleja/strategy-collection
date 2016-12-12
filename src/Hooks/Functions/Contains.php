<?php

namespace rc\Hooks\Functions;

use rc\CollectionInterface;

/**
 * @method bool contains($element)
*/
class Contains implements FunctionStrategyInterface {

    public function __invoke(CollectionInterface $collection,array $arguments = null)
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

