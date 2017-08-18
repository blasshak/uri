<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath;

/**
 * Interface GeneratePathInterface
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath
 */
interface GeneratePathInterface
{
    /**
     * @access public
     * @param array $parameters
     * @return array
     */
    public function __invoke(array $parameters);
}
