<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\Factory;

use Jht\CoreBundle\Lib\Uri\SeoRule\IsSeo\Generic\IsSeoInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\Canonical\CanonicalFacadeInterface;
use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Results\NotFoundFacade;

/**
 * Class SeoRuleFactoryInterface
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\Factory
 */
interface SeoRuleFactoryInterface
{
    /**
     * @access public
     * @return NotFoundFacade
     */
    public function createNotFoundFacade();

    /**
     * @access public
     * @param Boolean $notFound
     * @return NoIndexInterface
     */
    public function createNoIndexFacade($notFound);

    /**
     * @access public
     * @param Boolean $noIndex
     * @return NoIndexInterface
     */
    public function createNoFollowFacade($noIndex);

    /**
     * @access public
     * @param Boolean $noIndex
     * @return CanonicalFacadeInterface
     */
    public function createCanonicalFacade($noIndex);

    /**
     * @access public
     * @return IsSeoInterface
     */
    public function createIsSeo();
}
