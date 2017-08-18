<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;

/**
 * Interface CanonicalInterface
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Results
 */
interface CanonicalInterface
{
    /**
     * @access public
     * @return Boolean
     */
    public function mustChange();

    /**
     * @access public
     * @return InmuebleFilterObject $filterObject
     */
    public function change();
}
