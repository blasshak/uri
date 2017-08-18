<?php

namespace Jht\CoreBundle\Lib\Uri;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config\GenerateConfigFactory;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\GenerateUriInterface;
use Jht\CoreBundle\Lib\Uri\Exceptions\UriDependenciesException;
use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\ResultsFactory;
use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\SeoRuleFactoryInterface;
use Jht\ModelBundle\Entity\Repository\FiltroRepository;

/**
 * Class ResultsCreator
 * @package Jht\CoreBundle\Lib\Uri
 */
class ResultsCreator extends UriCreator
{
    /**
     * @access private
     * @var FiltroRepository
     */
    private $filtroRepo;

    /**
     * @access public
     * @param GenerateUriInterface $generateUri
     * @param FiltroRepository $filtroRepo
     */
    public function __construct(GenerateUriInterface $generateUri, FiltroRepository $filtroRepo)
    {
        $this->generateUri = $generateUri;
        $this->filtroRepo = $filtroRepo;
    }

    /**
     * @param array $dependencies
     * @throws UriDependenciesException
     */
    protected function validateDependencies(array $dependencies)
    {
        if (!isset($dependencies['filterObject'])) {
            throw UriDependenciesException::noExists('filterObject');
        }

        /** @var InmuebleFilterObject $filterObject */
        $filterObject = $dependencies['filterObject'];

        if (!$filterObject->isFilteredByCulture()) {
            throw UriDependenciesException::invalidValueFromDependencie('culture', 'filterObject');
        }

        if (!$filterObject->isFilteredByOperacion()) {
            throw UriDependenciesException::invalidValueFromDependencie('operacion', 'filterObject');
        }

        if (!$filterObject->isFilteredByCategoriaTipoInmueble()) {
            throw UriDependenciesException::invalidValueFromDependencie('categoriaTipoInmueble', 'filterObject');
        }

        if (!$filterObject->isFilteredByLocation()) {
            throw UriDependenciesException::invalidValueFromDependencie('location', 'filterObject');
        }

        if ($filterObject->isFilteredByZonas() and !$filterObject->isFilteredByPoblacion()) {
            throw UriDependenciesException::invalidValueFromDependencie('poblacion', 'filterObject');
        }
    }

    /**
     * @access protected
     * @param array $dependencies
     * @return String
     */
    protected function getUri(array $dependencies)
    {
        $dependencies['type'] = GenerateConfigFactory::KEY_RESULTS;
        $uri = $this->generateUri->__invoke($dependencies);

        return $uri;
    }

    /**
     * @access protected
     * @param array $dependencies
     * @param String $uri
     * @return SeoRuleFactoryInterface
     */
    protected function createSeoRuleFactory(array $dependencies, $uri)
    {
        if (!isset($dependencies['results'])) {
            $dependencies['results']['results']['total'] = 1;
        }

        $seoRuleFactory = new ResultsFactory(
            $dependencies['filterObject'],
            $this->filtroRepo,
            $uri,
            $dependencies['results'],
            $this->generateUri,
            $this->uriCollectionHandler
        );

        return $seoRuleFactory;
    }
}
