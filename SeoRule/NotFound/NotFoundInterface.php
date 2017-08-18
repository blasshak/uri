<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NotFound;

/**
 * Interface NotFoundInterface
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow
 */
interface NotFoundInterface
{
    /**
     * @access public
     * @return Boolean
     */
    public function is();

    /**
     * @access public
     * @return Integer
     */
    public function getStatusCode();
}
