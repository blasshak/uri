<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;

/**
 * Class NumPageNoIndex
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results
 */
class NumPageNoIndex implements NoIndexInterface
{
    // número màxim de pàgines indexables per SEO
    const MAX_NUM_PAGE_SEO = 3;

    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObject;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     */
    public function __construct(InmuebleFilterObject $filterObject)
    {
        $this->filterObject = $filterObject;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        if ($this->filterObject->isFilteredByPages()) {
            if ($this->filterObject->getPage() > self::MAX_NUM_PAGE_SEO) {
                return true;
            }
        }

        return false;
    }
}
