<?php

namespace rc;

use rc\Config\Configuration;
use rc\Hooks\Invariants\MinElements;

class CollectionRecursiveTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \InvalidArgumentException
    */
    public function testRecursiveFeature()
    {
        $collection = new feature([]);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testRecursiveLazy()
    {
        $collection = new lazy([]);
    }
}

class recursive extends BuilderCollection
{
    public function __construct(array $elements)
    {
        parent::__construct(new \rc\Config\Simple($elements));
    }
}

class RecursiveCollection extends recursive implements CollectionInterface
{
}


class feature extends BuilderCollection {

    public  function __construct(array $elements)
    {
        parent::__construct(
            (new \rc\Config\Simple($elements))
            ->addInvariant(new MinElements())
        );
    }
}

class lazy extends BuilderCollection {

    public  function __construct(array $elements)
    {
        $builder = new \rc\Config\Simple($elements);
        $builder->build();

        $builder->addInvariant(new MinElements());
        $builder->build();

        parent::__construct($builder);
    }
}
