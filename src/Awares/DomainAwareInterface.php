<?php

namespace rc\Awares;

interface DomainAwareInterface extends
    Functions\GetSize,
    Functions\Contains,
    Invariants\MaxElements,
    Invariants\MinElements
{
}
