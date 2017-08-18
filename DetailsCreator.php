<?php

namespace Jht\CoreBundle\Lib\Uri;

use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config\GenerateConfigFactory;
use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\GenerateUriInterface;
use Jht\CoreBundle\Lib\Uri\Exceptions\UriDependenciesException;
use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\DetailsFactory;
use Jht\CoreBundle\Lib\Uri\SeoRule\Factory\SeoRuleFactoryInterface;

/**
 * Class DetailsCreator
 * @package Jht\CoreBundle\Lib\Uri
 */
class DetailsCreator extends UriCreator
{
    /**
     * @access public
     * @param GenerateUriInterface $generateUri
     */
    public function __construct(GenerateUriInterface $generateUri)
    {
        $this->generateUri = $generateUri;
    }

    /**
     * @param array $dependencies
     * @throws UriDependenciesException
     */
    protected function validateDependencies(array $dependencies)
    {
        if (!isset($dependencies['culture'])) {
            throw UriDependenciesException::noExists('culture');
        }

        if (!isset($dependencies['inmueble'])) {
            throw UriDependenciesException::noExists('inmueble');
        }
    }

    /**
     * @access protected
     * @param array $dependencies
     * @return String
     */
    protected function getUri(array $dependencies)
    {
        $dependencies['type'] = GenerateConfigFactory::KEY_DETAILS;
        $uri = $this->generateUri->__invoke($dependencies);

        return $uri;
    }

    /**
     * @access protected
     * @param array $dependencies
     * @param String $uri
     * @return SeoRuleFactoryInterface
     */
    protected function createSeoRuleFactory(array $dependencies, $uri)
    {
        $seoRuleFactory = new DetailsFactory(
            $uri,
            $this->uriCollectionHandler
        );

        return $seoRuleFactory;
    }
}
