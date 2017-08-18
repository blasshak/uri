<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic;

use Jht\CoreBundle\Lib\Uri\Collection\UriCollectionHandler;

/**
 * Class IsSeo
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic
 */
class IsSeo implements IsSeoInterface
{
    /**
     * @access public
     * @var UriCollectionHandler
     */
    private $uriCollectionHandler;

    /**
     * @access public
     * @param UriCollectionHandler $uriCollectionHandler
     */
    public function __construct(UriCollectionHandler $uriCollectionHandler)
    {
        $this->uriCollectionHandler = $uriCollectionHandler;
    }

    /**
     * @access public
     * @param String $uri
     * @param Boolean $noIndex
     * @param Boolean $wasCanonized
     * @return bool
     */
    public function __invoke($uri, $noIndex, $wasCanonized)
    {
        if ($this->uriCollectionHandler->exists($uri)) {
            return false;
        }

        if ($noIndex) {
            return false;
        }

        if ($wasCanonized) {
            return false;
        }

        return true;
    }
}
