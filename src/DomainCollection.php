<?php

namespace rc;

use rc\Config\Domain;

class DomainCollection extends BuilderCollection
{
    public function __construct(array $elements = [])
    {
        parent::__construct(new Domain($elements));
    }
}
