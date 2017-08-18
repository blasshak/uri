<?php

namespace Jht\CoreBundle\Lib\Uri\Collection;

use Jht\CoreBundle\Lib\Uri\Uri;

/**
 * Class UriCollectionHandler
 *
 * @access public
 * @group uri
 * @group uri_collection
 * @package Jht\CoreBundle\Lib\Uri\Collection
 */
class UriCollectionHandler
{
    /**
     * @access private
     * @var UriCollection
     */
    private $uriCollection;

    /**
     * @access public
     */
    public function __construct()
    {
        $this->uriCollection = new UriCollection();
    }

    /**
     * @access public
     * @param String $uri
     * @return Uri
     */
    public function findBy($uri)
    {
        if ($this->exists($uri)) {
            return $this->uriCollection->offsetGet($uri);
        }

        return null;
    }

    /**
     * @access public
     * @param String $uri
     * @return Boolean
     */
    public function exists($uri)
    {
        if ($this->uriCollection->count() === 0) {
            return false;
        }

        if (!$this->uriCollection->offsetExists($uri)) {
            return false;
        }

        return true;
    }

    /**
     * @access public
     * @param Uri $uri
     * @return void
     */
    public function add(Uri $uri)
    {
        $this->uriCollection->set($uri->getUri(), $uri);
    }
}
