<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters;

/**
 * Class GetParameters
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters
 */
class GetParameters implements GetParametersInterface
{
    /**
     * @access private
     * @var GetParametersInterface
     */
    private $getParameters;

    /**
     * @access public
     * @param GetParametersInterface $getParameters
     */
    public function __construct(GetParametersInterface $getParameters)
    {
        $this->getParameters = $getParameters;
    }

    /**
     * @access public
     * @param GetParametersInterface $getParameters
     */
    public function set(GetParametersInterface $getParameters)
    {
        $this->getParameters = $getParameters;
    }

    /**
     * @access public
     * @return array
     */
    public function get()
    {
        return $this->getParameters->get();
    }
}
