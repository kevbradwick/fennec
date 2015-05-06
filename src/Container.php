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
        return $this->config->get($name);
    }
}