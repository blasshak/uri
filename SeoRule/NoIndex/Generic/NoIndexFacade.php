<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Generic;

use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;

/**
 * Class NoIndexFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Generic
 */
class NoIndexFacade implements NoIndexInterface
{
    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        return false;
    }
}
