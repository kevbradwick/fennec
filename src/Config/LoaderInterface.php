<?php

namespace Fennec\Config;


interface LoaderInterface
{
    /**
     * Load should return an associative array containing all the configured
     * services and factories.
     *
     * @return array
     */
    public function load();
}