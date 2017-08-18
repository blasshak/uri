<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic;

use Jht\CoreBundle\Lib\Uri\Collection\UriCollectionHandler;

/**
 * Interface IsSeoInterface
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic
 */
interface IsSeoInterface
{
    /**
     * @access public
     * @param UriCollectionHandler $uriCollectionHandler
     */
    public function __construct(UriCollectionHandler $uriCollectionHandler);

    /**
     * @access public
     * @param String $uri
     * @param Boolean $noIndex
     * @param Boolean $wasCanonized
     * @return Boolean
     */
    public function __invoke($uri, $noIndex, $wasCanonized);
}
