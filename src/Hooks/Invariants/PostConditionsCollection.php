<?php

namespace rc\Hooks\Invariants;

use rc\Hooks\SingleImmutableCollection;

final class PostConditionsCollection extends SingleImmutableCollection
{
    public function __construct(array $elements =[])
    {
        parent::__construct('rc\Hooks\Invariants\PostConditionStrategyInterface', $elements);
    }
}
