<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Generic;

use Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\NotFoundInterface;
use Jht\CoreBundle\Lib\Uri\Uri;

/**
 * Class NotFoundFacade
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NotFound\Generic
 */
class NotFoundFacade implements NotFoundInterface
{
    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
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
