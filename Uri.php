<?php

namespace Jht\CoreBundle\Lib\Uri;

use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\SeoRuleFactoryInterface;

/**
 * Class Uri
 *
 * @access public
 * @package Jht\CoreBundle\Lib\Uri
 */
class Uri
{
    const STATUS_CODE_OK = 200;
    const STATUS_CODE_NOT_FOUND = 404;

    /**
     * @access private
     * @var String
     */
    private $uri;

    /**
     * @access private
     * @var Boolean
     */
    private $notFound;

    /**
     * @access private
     * @var Boolean
     */
    private $noIndex;

    /**
     * @access private
     * @var Boolean
     */
    private $noFollow;

    /**
     * @access private
     * @var String
     */
    private $canonical;

    /**
     * @access private
     * @var Boolean
     */
    private $wasCanonized;

    /**
     * @access private
     * @var Boolean
     */
    private $isSeo;

    /**
     * @access private
     * @var Integer
     */
    private $statusCode;

    /**
     * @access private
     * @param string $uri
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function __construct($uri, SeoRuleFactoryInterface $seoRuleFactory)
    {
        $this->uri = $uri;
        $this->applySeoRules($uri, $seoRuleFactory);
    }

    /**
     * @access public
     * @param $uri
     * @param SeoRuleFactoryInterface $seoRuleFactory
     * @return Uri
     */
    public static function create($uri, SeoRuleFactoryInterface $seoRuleFactory)
    {
        $uri = new self($uri, $seoRuleFactory);

        return $uri;
    }

    /**
     * @access public
     * @return String
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function getNotFound()
    {
        return $this->notFound;
    }

    /**
     * @access public
     * @return Integer
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function getNoIndex()
    {
        return $this->noIndex;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function getNoFollow()
    {
        return $this->noFollow;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function getCanonical()
    {
        return $this->canonical;
    }

    /**
     * @access public
     * @return Boolean
     */
    public function isSeo()
    {
        return $this->isSeo;
    }
    /**
     * @access private
     * @param String $uri
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function applySeoRules($uri, SeoRuleFactoryInterface $seoRuleFactory)
    {
        $this->setNotFound($seoRuleFactory);
        $this->setNoIndex($seoRuleFactory);
        $this->setNoFollow($seoRuleFactory);
        $this->setCanonical($seoRuleFactory);
        $this->setIsSeo($uri, $seoRuleFactory);
    }

    /**
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function setNotFound(SeoRuleFactoryInterface $seoRuleFactory)
    {
        $notFoundFacade = $seoRuleFactory->createNotFoundFacade();
        $this->notFound = $notFoundFacade->is();
        $this->setStatusCode($notFoundFacade->getStatusCode());
    }

    /**
     * @param Integer $statusCode
     */
    private function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function setNoIndex(SeoRuleFactoryInterface $seoRuleFactory)
    {
        $noIndexFacade = $seoRuleFactory->createNoIndexFacade($this->notFound);
        $this->noIndex = $noIndexFacade->is();
    }

    /**
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function setNoFollow(SeoRuleFactoryInterface $seoRuleFactory)
    {
        $noFollowFacade = $seoRuleFactory->createNoFollowFacade($this->noIndex);
        $this->noFollow = $noFollowFacade->is();
    }

    /**
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    private function setCanonical(SeoRuleFactoryInterface $seoRuleFactory)
    {
        $canonicalFacade = $seoRuleFactory->createCanonicalFacade($this->noIndex);
        $this->canonical = $canonicalFacade->get();
        $this->wasCanonized = $canonicalFacade->wasCanonized();
    }

    /**
     * @param $uri
     * @param SeoRuleFactoryInterface $seoRuleFactory
     */
    public function setIsSeo($uri, SeoRuleFactoryInterface $seoRuleFactory)
    {
        $isSeo = $seoRuleFactory->createIsSeo();
        $this->isSeo = $isSeo->__invoke($uri, $this->noIndex, $this->wasCanonized);
    }
}
