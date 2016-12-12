<?php

namespace rc\Hooks\Functions;

use rc\CollectionInterface;

/**
 * @method bool executeService($arguments)
*/
class ExecuteService implements FunctionStrategyInterface {

    public function __invoke(CollectionInterface $collection,array $arguments = null)
    {
        list($serviceName) = $arguments;

        foreach ($collection as $element) {
            if ($element === 'service') return $serviceName;
        };

        return false;
    }

    public function name()
    {
        return 'executeService';
    }
}

