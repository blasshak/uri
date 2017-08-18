<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Helper\StringHelper;

/**
 * Class GeneratePathToResults
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath
 */
class GeneratePathToResults implements GeneratePathInterface
{
    /**
     * @access public
     * @param array $parameters
     * @return array
     */
    public function __invoke(array $parameters)
    {
        unset($parameters[InmuebleFilterObject::KEY_CULTURE]);

        return rtrim(StringHelper::implode(array('/', ','), $parameters), "/");
    }
}
