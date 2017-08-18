<?php
namespace Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Class GetParametersByRequest
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters
 */
class GetParametersByRequest implements GetParametersInterface
{
    /**
     * @access private
     * @var RequestStack
     */
    private $request;

    /**
     * @access public
     * @param RequestStack $request
     */
    public function __construct(RequestStack $request)
    {
        $this->request = $request;
    }

    /**
     * @access public
     * @return array
     */
    public function get()
    {
        $request = $this->request->getCurrentRequest();
        $getParametersByUri = new GetParametersByUri($request->getUri());

        return $getParametersByUri->get();
    }
}
