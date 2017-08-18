<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config;

/**
 * Class NullConfig
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config
 */
class NullConfig implements GenerateConfigInterface
{
    /**
     * @access public
     * @return String
     */
    public function __invoke()
    {
        return array();
    }
}
