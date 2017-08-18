<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri;

/**
 * Interface GenerateUriInterface
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri
 */
interface GenerateUriInterface
{
    /**
     * @access public
     * @param array $dependencies
     * @return String
     */
    public function __invoke(array $dependencies);
}
