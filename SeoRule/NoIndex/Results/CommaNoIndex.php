<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results;

use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;

/**
 * Class CommaNoIndex
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results
 */
class CommaNoIndex implements NoIndexInterface
{
    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access public
     * @param String $uri
     */
    public function __construct($uri)
    {
        $this->uri = $uri;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        if ((strpos($this->uri, ',') !== false)) {
            return true;
        }

        return false;
    }
}
