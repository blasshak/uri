<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Factory;

use Jht\CoreBundle\Lib\Uri\Collection\UriCollectionHandler;
use Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic\IsSeo;
use Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic\IsSeoInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\NoFollowInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Generic\NoFollowFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Generic\NoIndexFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\CanonicalFacadeInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Generic\CanonicalFacade;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\NotFoundInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Generic\NotFoundFacade;

/**
 * Class DetailsFactory
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\Factory
 */
final class DetailsFactory implements SeoRuleFactoryInterface
{
    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access private
     * @var UriCollectionHandler
     */
    private $uriCollectionHandler;

    /**
     * @access public
     * @param String $uri
     * @param UriCollectionHandler $uriCollectionHandler
     */
    public function __construct($uri, UriCollectionHandler $uriCollectionHandler)
    {
        $this->uri = $uri;
        $this->uriCollectionHandler = $uriCollectionHandler;
    }

    /**
     * @access public
     * @return NotFoundInterface
     */
    public function createNotFoundFacade()
    {
        $facade = new NotFoundFacade();

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $notFound
     * @return NoIndexInterface
     */
    public function createNoIndexFacade($notFound)
    {
        $facade = new NoIndexFacade();

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $noIndex
     * @return NoFollowInterface
     */
    public function createNoFollowFacade($noIndex)
    {
        $facade = new NoFollowFacade();

        return $facade;
    }

    /**
     * @access public
     * @param Boolean $noIndex
     * @return CanonicalFacadeInterface
     */
    public function createCanonicalFacade($noIndex)
    {
        $facade = new CanonicalFacade($this->uri);

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
