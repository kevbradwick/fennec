<?php

namespace Fennec;


class Container
{
    /**
     * @var Config
     */
    private $config;

    public function __construct($config)
    {
        $this->config = new Config($config);
    }

    public function get($name)
    {
        $config = $this->config->get($name);

        if (!$config) {
            return null;
        }

        $class = new \ReflectionClass($config['class']);

        if (isset($config['construct'])) {
            $args = [];
            foreach ($config['construct'] as $arg) {
                preg_match('/^ref\#(?P<conf>[a-z0-9\.\-_]+)$/i', $arg, $matches);
                if (isset($matches['conf'])) {
                    $args[] = $this->get($matches['conf']);
                } else {
                    $args[] = $arg;
                }
            }

            $instance = $class->newInstanceArgs($args);
        } else {
            $instance = $class->newInstance();
        }

        return $instance;
    }
}