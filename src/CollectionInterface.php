<?php

namespace rc;

interface CollectionInterface extends \ArrayAccess, \Countable
{
    public function getIterator();
}