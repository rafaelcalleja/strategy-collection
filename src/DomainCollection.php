<?php

namespace rc;

use rc\Config\Domain;
use rc\Hooks\Functions\Contains;
use rc\Hooks\Functions\GetSize;

/**
 * @mixin GetSize
 * @mixin Contains
 */
class DomainCollection extends BuilderCollection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(new Domain($elements));
    }
}
