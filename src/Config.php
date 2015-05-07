<?php

namespace Fennec;


use Fennec\Config\YamlLoader;

/**
 * Class Config
 *
 * @package Fennec
 */
class Config implements \ArrayAccess
{
    private $data = array();

    /**
     * @param string $fileName
     *
     * @throws \InvalidArgumentException when unable to load config file
     */
    public function __construct($fileName)
    {
        preg_match('/^.+?\.(?P<ext>[a-z]+)$/i', $fileName, $matches);

        if (!isset($matches['ext'])) {
            throw new \InvalidArgumentException(
                sprintf('"%s" is not a supported configuration format',
                    $fileName));
        }

        switch ($matches['ext']) {
            case 'yaml':
            case 'yml':
                $loader = new YamlLoader($fileName);
                break;
            default:
                throw new \InvalidArgumentException(
                    sprintf('"%s" is not a supported configuration format',
                        $fileName));
                break;
        }

        // TODO transform each array config into a struct
        $this->data = $loader->load();
    }

    /**
     * @param string $name
     * @return mixed
     */
    public function get($name)
    {
        if ($this->offsetExists($name)) {
            return $this->offsetGet($name);
        }
    }

    /**
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    /**
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    /**
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->data[$offset] = $value;
    }

    /**
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

}