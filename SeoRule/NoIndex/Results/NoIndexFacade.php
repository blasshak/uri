<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;
use Jht\ModelBundle\Entity\Repository\FiltroRepository;

/**
 * Class NoIndexFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results
 */
class NoIndexFacade implements NoIndexInterface
{
    /**
     * @access private
     * @var Boolean
     */
    private $notFound;

    /**
     * @access private
     * @var array
     */
    private $strategies;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObject
     * @param FiltroRepository $filtroRepo
     * @param $uri
     * @param array $results
     * @param Boolean $notFound
     */
    public function __construct(
        InmuebleFilterObject $filterObject,
        FiltroRepository $filtroRepo,
        $uri,
        array $results,
        $notFound
    ) {
        $this->notFound = $notFound;
        $this->strategies = array();

        $this->addStrategy(new NumPageNoIndex($filterObject));
        $this->addStrategy(new CommaNoIndex($uri));
        $this->addStrategy(new ResultsNoIndex($results));
    }

    /**
     * @access public
     * @param NoIndexInterface $noIndex
     */
    private function addStrategy(NoIndexInterface $noIndex)
    {
        $this->strategies[] = $noIndex;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        if ($this->notFound) {
            return true;
        }

        foreach ($this->strategies as $strategy) {
            if ($strategy->is()) {
                return true;
            }
        }

        return false;
    }
}
