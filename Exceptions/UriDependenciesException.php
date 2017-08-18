<?php

namespace Jht\CoreBundle\Lib\Uri\Exceptions;

/**
 * Class UriDependenciesException
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri\Exceptions
 */
class UriDependenciesException extends \Exception
{
    /**
     * @return static
     */
    public static function noExists($dependencie)
    {
        return new static(
            sprintf('%s dependence no exists', $dependencie)
        );
    }

    /**
     * @return static
     */
    public static function invalidValueFromDependencie($value, $dependencie)
    {
        return new static(
            sprintf('Invalid %s from %s', $value, $dependencie)
        );
    }
}
