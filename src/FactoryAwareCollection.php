<?php

namespace rc;

use rc\Hooks\Factory\CollectionStrategyInterface;

abstract class FactoryAwareAbstractFactoryCollection extends AbstractFactoryCollection
{
    const TYPE_FUNCTIONS = 'Functions';
    const TYPE_INVARIANTS = 'Invariants';
    const TYPE_COLLECTION = 'Factory';

    public function __construct(array $elements)
    {
        $functions = $this->resolveInterfaces(self::TYPE_FUNCTIONS);
        $invariants = $this->resolveInterfaces(self::TYPE_INVARIANTS);

        /** @var CollectionStrategyInterface $collection */
        $collection = $this->resolveInterfaces(self::TYPE_COLLECTION);

        if ( null === $collection ){
            throw new \RuntimeException('Invalid collection strategy');
        }

        parent::__construct(
            new Configuration(
                $collection->create($elements),
                $invariants,
                $functions
            )
        );
    }

    private function classBasename($class){
        return basename(str_replace('\\', '/', $class));
    }

    /**
     * @param $functions
     * @param $invariants
     * @return array
     */
    private function resolveInterfaces($type)
    {
        $instances = [];

        switch ($type){
            case self::TYPE_FUNCTIONS:
            case self::TYPE_INVARIANTS:
                    foreach (class_implements($this) as $class) {
                        if (strpos($class, 'rc\\Awares\\'.$type) === 0) {
                            $hook = sprintf("%s\\%s", 'rc\\Hooks\\'.$type, $this->classBasename($class));
                            $instances[] = new $hook();
                        }
                    }
                break;
            case self::TYPE_COLLECTION:
                foreach (class_implements($this) as $class) {
                    if (strpos($class, 'rc\\Awares\\'.$type) === 0) {
                        $hook = sprintf("%s\\%s", 'rc\\Hooks\\'.$type, $this->classBasename($class));
                        return new $hook();
                    }
                }
                return null;
                break;
        }
        return $instances;
    }
}
