<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath;

/**
 * Class GeneratePathToInmuebleDetails
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath
 */
class GeneratePathToInmuebleDetails implements GeneratePathInterface
{

    /**
     * @access public
     * @param array $parameters
     * @return array
     */
    public function __invoke(array $parameters)
    {
        $path = '/[operacion]/[tipo_inmueble]/[inmueble]-[referencia]';

        if (count($parameters) > 0) {
            foreach ($parameters as $key => $val) {
                $path = str_replace("[".$key."]", $parameters[$key], $path);
            }
        }

        return $path;
    }
}
