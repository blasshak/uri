<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\Results;

use Jht\CoreBundle\Lib\FilterObject\Builder\Inmueble\ConcreteProduct\InmuebleFilterObject;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config\GenerateConfigFactory;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\GenerateUriInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\CanonicalFacadeInterface;
use Jht\ModelBundle\Entity\Repository\FiltroRepository;

/**
 * Class CanonicalFacade
 *
 * @access public
 * @package Jht\CoreBundle\FilterObject\Lib\Canonical\Results
 */
class CanonicalFacade implements CanonicalFacadeInterface
{
    /**
     * @access public
     * @var InmuebleFilterObject
     */
    private $filterObj;

    /**
     * @access public
     * @var GenerateUriInterface
     */
    private $generateUri;

    /**
     * @access private
     * @var array
     */
    private $strategies;

    /**
     * @access private
     * @var Boolean
     */
    private $wasCanonized;

    /**
     * @access public
     * @param InmuebleFilterObject $filterObj
     * @param FiltroRepository $filtroRepo
     * @param GenerateUriInterface $generateUri
     * @param Boolean $noIndex
     */
    public function __construct(
        InmuebleFilterObject $filterObj,
        FiltroRepository $filtroRepo,
        GenerateUriInterface $generateUri,
        $noIndex
    ) {
        $this->filterObj = $filterObj->deepCopy();
        $this->generateUri = $generateUri;
        $this->strategies  = array();
        $this->wasCanonized = false;

        if (!$noIndex) {
            $this->addStrategy(new BarrioCanonical($this->filterObj));
        }
    }

    /**
     * @access private
     * @param CanonicalInterface $canonical
     * @return void
     */
    private function addStrategy(CanonicalInterface $canonical)
    {
        $this->strategies[] = $canonical;
    }

    /**
     * @access public
     * @return String
     */
    public function get()
    {
        foreach ($this->strategies as $strategy) {
            if ($strategy->mustChange()) {
                $this->wasCanonized = true;
                $strategy->change();
            }
        }

        $dependencies = array('type' => GenerateConfigFactory::KEY_RESULTS, 'filterObject' => $this->filterObj);

        return $this->generateUri->__invoke($dependencies);
    }

    /**
     * @access public
     * @return Boolean
     */
    public function wasCanonized()
    {
        return $this->wasCanonized;
    }
}
