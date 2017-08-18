<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config;

use Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath\GeneratePathInterface;
use Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters\GetParametersInterface;

/**
 * Class Details
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config
 */
class Details implements GenerateConfigInterface
{
    /**
     * @access private
     * @var GetParametersInterface
     */
    private $getParameters;

    /**
     * @access private
     * @var GeneratePathInterface
     */
    private $generatePath;

    /**
     * @access private
     * @var String
     */
    private $culture;

    /**
     * @access public
     * @param GetParametersInterface $getParameters
     * @param GeneratePathInterface $generatePath
     * @param String $culture
     */
    public function __construct(
        GetParametersInterface $getParameters,
        GeneratePathInterface $generatePath,
        $culture
    ) {
        $this->getParameters = $getParameters;
        $this->generatePath = $generatePath;
        $this->culture = $culture;
    }

    /**
     * @access public
     * @return String
     */
    public function __invoke()
    {
        $parameters = $this->getParameters->get();
        $path = $this->generatePath->__invoke($parameters);

        return array('path' => $path, 'culture' => $this->culture);
    }
}
