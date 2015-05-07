<?php

namespace Fennec\Config;


class YamlLoader extends AbstractLoader
{
    public function load()
    {
        $config = yaml_parse_file($this->getFileName());
        if (isset($config['include'])) {
            foreach ($config['include'] as $other) {
                $include = yaml_parse_file($other);
                $config = array_replace_recursive($include, $config);
            }
        }

        // TODO check each config construct for incorrect structure before returning
        return $config;
    }
}