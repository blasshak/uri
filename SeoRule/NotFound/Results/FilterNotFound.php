<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results;

use Jht\CoreBundle\Lib\FilterGroup\Filter\Factory\ConcreteProduct\Filter;
use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\NotFoundInterface;
use Jht\CoreBundle\Lib\Uri\Uri;

/**
 * Class FilterNotFound
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results
 */
class FilterNotFound implements NotFoundInterface
{
    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObject;

    /**
     * @access private
     * @var array
     */
    private $results;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param array $results
     */
    public function __construct(InmuebleFilterObject $filterObject, $results)
    {
        $this->filterObject = $filterObject;
        $this->results = $results;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        if ($this->filterObject->hasFilter(Filter::KEY_PERMUTA) && intval($this->results['results']['total']) === 0) {
            return true;
        }

        return false;
    }

    /**
     * @access public
     * @return Integer
     */
    public function getStatusCode()
    {
        return Uri::STATUS_CODE_OK;
    }
}
