<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Factory;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\GenerateUriInterface;
use Jht\CoreBundle\Lib\Uri\Collection\UriCollectionHandler;
use Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic\IsSeo;
use Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic\IsSeoInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\NoFollowInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Results\NoFollowFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results\NoIndexFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\CanonicalFacadeInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Results\CanonicalFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\NotFoundInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results\NotFoundFacade;
use Jht\ModelBundle\Entity\Repository\FiltroRepository;

/**
 * Class ResultsFactory
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\Factory
 */
final class ResultsFactory implements SeoRuleFactoryInterface
{
    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObject;

    /**
     * @access private
     * @var FiltroRepository
     */
    private $filtroRepo;

    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access private
     * @var array
     */
    private $results;

    /**
     * @access private
     * @var GenerateUriInterface
     */
    private $generateUri;

    /**
     * @access private
     * @var UriCollectionHandler
     */
    private $uriCollectionHandler;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param FiltroRepository $filtroRepo
     * @param String $uri
     * @param array $results
     * @param GenerateUriInterface $generateUri
     * @param UriCollectionHandler $uriCollectionHandler
     */
    public function __construct(
        InmuebleFilterObject $filterObject,
        FiltroRepository $filtroRepo,
        $uri,
        array $results,
        GenerateUriInterface $generateUri,
        UriCollectionHandler $uriCollectionHandler
    ) {
        $this->filterObject = $filterObject;
        $this->filtroRepo = $filtroRepo;
        $this->uri = $uri;
        $this->results = $results;
        $this->generateUri = $generateUri;
        $this->uriCollectionHandler = $uriCollectionHandler;
    }

    /**
     * @access public
     * @return NotFoundInterface
     */
    public function createNotFoundFacade()
    {
        $facade = new NotFoundFacade($this->filterObject, $this->results);

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $notFound
     * @return NoIndexInterface
     */
    public function createNoIndexFacade($notFound)
    {
        $facade = new NoIndexFacade($this->filterObject, $this->filtroRepo, $this->uri, $this->results, $notFound);

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $noIndex
     * @return NoFollowInterface
     */
    public function createNoFollowFacade($noIndex)
    {
        $facade = new NoFollowFacade($this->filterObject, $noIndex);

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $noIndex
     * @return CanonicalFacadeInterface
     */
    public function createCanonicalFacade($noIndex)
    {
        $facade = new CanonicalFacade($this->filterObject, $this->filtroRepo, $this->generateUri, $noIndex);

        return $facade;
    }

    /**
     * @access public
     * @return IsSeoInterface
     */
    public function createIsSeo()
    {
        $facade = new IsSeo($this->uriCollectionHandler);

        return $facade;
    }
}
