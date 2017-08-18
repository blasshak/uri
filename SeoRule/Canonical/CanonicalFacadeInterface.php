<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Canonical;

/**
 * Interface CanonicalFacadeInterface
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\Canonical
 * Jht\CoreBundle\Lib\Uri\SlugGroup
 */
interface CanonicalFacadeInterface
{
    /**
     * @access public
     * @return String
     */
    public function get();

    /**
     * @access public
     * @return Boolean
     */
    public function wasCanonized();
}
