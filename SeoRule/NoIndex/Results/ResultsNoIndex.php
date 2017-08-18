<?php

namespace Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results;

use Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\NoIndexInterface;

/**
 * Class ResultsNoIndex
 * @package Jht\CoreBundle\Lib\Uri\SeoRule\NoIndex\Results
 */
class ResultsNoIndex implements NoIndexInterface
{
    /**
     * @access private
     * @var array
     */
    private $results;

    /**
     * @access public
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function is()
    {
        if (!isset($this->results['results']['total'])) {
            return true;
        }

        if (intval($this->results['results']['total']) === 0) {
            return true;
        }

        return false;
    }
}
