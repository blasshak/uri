<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;

/**
 * Class BarrioCanonical
 *
 * @access public
 * @package Jht\CoreBundle\FilterObject\Lib\Canonical\Results
 */
class BarrioCanonical implements CanonicalInterface
{
    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObj;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObj
     */
    public function __construct(InmuebleFilterObject $filterObj)
    {
        $this->filterObj = $filterObj;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function mustChange()
    {
        if ($this->filterObj->isFilteredByDistritos() && $this->filterObj->isFilteredByBarrios()) {
            return true;
        }

        return false;
    }

    /**
     * @access public
     * @return InmuebleFilterObject $filterObject
     */
    public function change()
    {
        $this->filterObj->removeDistrito();

        return $this->filterObj;
    }
}
