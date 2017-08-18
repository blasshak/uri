<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri;

use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config\GenerateConfigFactory;
use Symfony\Component\Routing\Router;

/**
 * Class GenerateUriByRouter
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri
 */
class GenerateUriByRouter implements GenerateUriInterface
{
    /**
     * @access private
     * @var Router
     */
    private $router;

    /**
     * @access private
     * @var GenerateConfigFactory
     */
    private $generateConfigFactory;

    /**
     * @access private
     * @var array
     */
    private $config;

    /**
     * @access public
     * @param Router $router
     * @param GenerateConfigFactory $generateConfigFactory
     */
    public function __construct(Router $router, GenerateConfigFactory $generateConfigFactory)
    {
        $this->router = $router;
        $this->generateConfigFactory = $generateConfigFactory;
        $this->config = array(
            'referenceType' => Router::ABSOLUTE_URL
        );
    }

    /**
     * @access public
     * @param array $dependencies
     * @return String
     */
    public function __invoke(array $dependencies)
    {
        $generateConfig = $this->generateConfigFactory->create($dependencies);
        $config = $generateConfig->__invoke();
        $config = array_merge($this->config, $config);
        $uri = $this->router->generate($config['name'], $config['parameters'], $config['referenceType']);

        return $uri;
    }
}
