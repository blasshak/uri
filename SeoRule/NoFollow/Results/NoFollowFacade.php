<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\NoFollowInterface;

/**
 * Class NoFollowFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Results
 */
class NoFollowFacade implements NoFollowInterface
{
    /**
     * @access private
     * @var array
     */
    private $strategies;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param Boolean $isNoIndex
     */
    public function __construct(
        InmuebleFilterObject $filterObject,
        $isNoIndex
    ) {
        $this->strategies = array();

        $this->addStrategy(new FilterNoFollow($filterObject, $isNoIndex));
    }

    /**
     * @access public
     * @param NoFollowInterface $noIndex
     */
    private function addStrategy(NoFollowInterface $noIndex)
    {
        $this->strategies[] = $noIndex;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->is()) {
                return true;
            }
        }

        return false;
    }
}
