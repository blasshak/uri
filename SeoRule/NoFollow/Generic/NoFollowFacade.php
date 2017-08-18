<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Generic;

use Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\NoFollowInterface;

/**
 * Class NoFollowFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoFollow\Generic
 */
class NoFollowFacade implements NoFollowInterface
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
