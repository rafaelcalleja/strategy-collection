<?php

namespace rc\Hooks\Functions;

use rc\CollectionInterface;

/**
 * @method int getSize
 */
class GetSize implements FunctionStrategyInterface
{
    public function __invoke(CollectionInterface $collection, array $arguments = null)
    {
        return count($collection);
    }

    public function name()
    {
        return 'getSize';
    }
}
