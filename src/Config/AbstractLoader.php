<?php

namespace Fennec\Config;


abstract class AbstractLoader implements LoaderInterface
{
    /**
     * @var string
     */
    private $fileName;

    public function __construct($fileName)
    {
        if (!file_exists($fileName)) {
            throw new \InvalidArgumentException(
                sprintf('"%s" does not exist', $fileName));
        }

        $this->fileName = $fileName;

        $this->init();
    }

    protected function init()
    {

    }

    /**
     * @return string
     */
    protected function getFileName()
    {
        return $this->fileName;
    }
}