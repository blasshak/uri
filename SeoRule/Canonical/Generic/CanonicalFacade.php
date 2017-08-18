<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Generic;

use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\CanonicalFacadeInterface;

/**
 * Class CanonicalFacade
 *
 * @access public
 * @package Jht\CoreBundle\FilterObject\Lib\Canonical\Generic
 */
class CanonicalFacade implements CanonicalFacadeInterface
{
    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access private
     * @var Boolean
     */
    private $wasCanonized;

    /**
     * @access public
     * @param String $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
        $this->wasCanonized = false;
    }

    /**
     * @access public
     * @return String
     */
    public function get()
    {
        return $this->uri;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function wasCanonized()
    {
        return $this->wasCanonized;
    }
}
