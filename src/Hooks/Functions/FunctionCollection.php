<?php

namespace rc\Hooks\Functions;

use rc\Hooks\SingleImmutableCollection;

final class FunctionCollection extends SingleImmutableCollection
{
    public function __construct(array $elements =[])
    {
        parent::__construct('rc\Hooks\Functions\FunctionStrategyInterface', $elements);
    }
}
