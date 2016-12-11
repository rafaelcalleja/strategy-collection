<?php

namespace rc;

use rc\Config\ConfigurationBuilderInterface;

abstract class BuilderCollection extends CollectionContext
{
    public function __construct(ConfigurationBuilderInterface $builder)
    {
        parent::__construct($builder->build());
    }
}
