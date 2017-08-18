<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\NotFoundInterface;
use Jht\CoreBundle\Lib\Uri\Uri;

/**
 * Class NotFoundFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results
 */
class NotFoundFacade implements NotFoundInterface
{
    /**
     * @access private
     * @var Integer
     */
    private $statusCode;

    /**
     * @access private
     * @var array
     */
    private $strategies;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param array $results
     */
    public function __construct(
        InmuebleFilterObject $filterObject,
        $results
    ) {
        $this->strategies = array();
        $this->statusCode = Uri::STATUS_CODE_OK;

        $this->addStrategy(new FilterNotFound($filterObject, $results));
    }

    /**
     * @access public
     * @param NotFoundInterface $noIndex
     */
    private function addStrategy(NotFoundInterface $noIndex)
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
                $this->statusCode = $strategy->getStatusCode();
                return true;
            }
        }

        return false;
    }

    /**
     * @access public
     * @return Integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
