<?php

namespace Jht\CoreBundle\Lib\Uri;

use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\GenerateUriInterface;
use Jht\CoreBundle\Lib\Uri\Collection\UriCollectionHandler;
use Jht\CoreBundle\Lib\Uri\Exceptions\UriDependenciesException;
use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\SeoRuleFactoryInterface;

/**
 * Abstract Class UriCreator
 * @package Jht\CoreBundle\Lib\Uri
 */
abstract class UriCreator
{
    /**
     * @access private
     * @var UriCollectionHandler
     */
    protected $uriCollectionHandler;

    /**
     * @access protected
     * @var GenerateUriInterface
     */
    protected $generateUri;

    /**
     * @access public
     * @param UriCollectionHandler $uriCollectionHandler
     * @internal param UriCollection $uriCollection
     */
    public function setUriCollectionHandler(UriCollectionHandler $uriCollectionHandler)
    {
        $this->uriCollectionHandler = $uriCollectionHandler;
    }

    /**
     * @access public
     * @param array $dependencies
     * @return Uri
     */
    public function create($dependencies = array())
    {
        $this->validateDependencies($dependencies);
        $uri = $this->getUri($dependencies);
        $seoRuleFactory = $this->createSeoRuleFactory($dependencies, $uri);
        $uriObject = $this->uriCollectionHandler->findBy($uri);

        if ($uriObject !== null) {
            $uriObject->setIsSeo($uri, $seoRuleFactory);
            return $uriObject;
        }

        $uriObject = Uri::create($uri, $seoRuleFactory);
        $this->uriCollectionHandler->add($uriObject);

        return $uriObject;
    }

    /**
     * @access protected
     * @param array $dependencies
     * @throws UriDependenciesException
     */
    abstract protected function validateDependencies(array $dependencies);

    /**
     * @access protected
     * @param array $dependencies
     * @return String
     */
    abstract protected function getUri(array $dependencies);

    /**
     * @access protected
     * @param array $dependencies
     * @param String $uri
     * @return SeoRuleFactoryInterface
     */
    abstract protected function createSeoRuleFactory(array $dependencies, $uri);
}
