<?php

namespace kosuha606\Tester;

use Psr\Container\ContainerInterface;

class Tester implements ContainerInterface
{
    /**
     * @var array
     */
    private $testMap = [];

    /**
     * @var array
     */
    private $testResults = [];

    /**
     * @param $object
     * @return mixed
     * @throws \Exception
     */
    public function get($object)
    {
        if ($this->has($object)) {
            $class = get_class($object);
            if ($result = call_user_func($this->testMap[$class])) {
                $this->testResults[$class] = $result;
                return $object;
            }
        }

        throw new \Exception("No test for class $class");
    }

    /**
     * @param $object
     * @return bool
     */
    public function has($object)
    {
        $class = get_class($object);
        return isset($this->testMap[$class]);
    }

    /**
     * @param $object
     * @return bool
     */
    public function passed($object)
    {
        $class = get_class($object);
        return !empty($this->testResults[$class]);
    }

    /**
     * @param mixed $testMap
     */
    public function setTestMap($testMap)
    {
        $this->testMap = $testMap;
    }
}
