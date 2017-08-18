<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Results;

use Jht\CoreBundle\Lib\FilterGroup\Factory\ConcreteProduct\FilterGroup;
use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\NoFollowInterface;

/**
 * Class FilterNoFollow
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Results
 */
class FilterNoFollow implements NoFollowInterface
{
    /**
     * @access private
     * @var InmuebleFilterObject
     */
    private $filterObject;

    /**
     * @access private
     * @var Boolean
     */
    private $isNoIndex;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param Boolean $isNoIndex
     */
    public function __construct(InmuebleFilterObject $filterObject, $isNoIndex)
    {
        $this->filterObject = $filterObject;
        $this->isNoIndex = $isNoIndex;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        $radio = $this->filterObject->getFilterGroup(FilterGroup::KEY_RADIO);

        if ($radio->exists() and $this->isNoIndex) {
            return true;
        }

        return false;
    }
}
