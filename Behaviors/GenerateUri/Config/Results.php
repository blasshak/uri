<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\SlugObject\Builder\Inmueble\ConcreteCreator\InmuebleSlugObjectBuilderInterface;
use Jht\CoreBundle\Lib\Uri\Behaviors\GeneratePath\GeneratePathInterface;
use Jht\CoreBundle\Lib\Uri\Behaviors\GetParameters\GetParametersByInmuebleSlugObject;

/**
 * Class Results
 *
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config
 */
class Results implements GenerateConfigInterface
{
    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObject;

    /**
     * @access private
     * @var InmuebleSlugObjectBuilderInterface
     */
    private $buildInmuebleSlugObjectBehavior;

    /**
     * @access private
     * @var GeneratePathInterface
     */
    private $generatePath;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param InmuebleSlugObjectBuilderInterface $buildInmuebleSlugObjectBehavior
     * @param GeneratePathInterface $generatePath
     */
    public function __construct(
        InmuebleFilterObject $filterObject,
        InmuebleSlugObjectBuilderInterface $buildInmuebleSlugObjectBehavior,
        GeneratePathInterface $generatePath
    ) {
        $this->filterObject = $filterObject;
        $this->buildInmuebleSlugObjectBehavior = $buildInmuebleSlugObjectBehavior;
        $this->generatePath = $generatePath;
    }

    /**
     * @access public
     * @return String
     */
    public function __invoke()
    {
        $culture = $this->filterObject->getCulture();
        $slugObject = $this->buildInmuebleSlugObjectBehavior->build($this->filterObject);
        $getParameters = new GetParametersByInmuebleSlugObject($slugObject);
        $parametes = $getParameters->get();

        $path = $this->generatePath->__invoke($parametes);

        return array('path' => $path, 'culture' => $culture);
    }
}
