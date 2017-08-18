<?php

namespace Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri;

use Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri\Config\GenerateConfigFactory;
use Tools\Helper\UrlHelper;

/**
 * Class GenerateUriByUrlHelper
 * @package Jht\CoreBundle\Lib\Uri\Behaviors\GenerateUri
 */
class GenerateUriByUrlHelper implements GenerateUriInterface
{
    /**
     * @access private
     * @var GenerateConfigFactory
     */
    private $generateConfigFactory;

    /**
     * @access private
     * @var String
     */
    private $hosts;

    /**
     * @access private
     * @var String
     */
    private $environment;

    /**
     * @access private
     * @var String
     */
    private $urlScheme;

    /**
     * @access private
     * @var array
     */
    private $config;

    /**
     * @access public
     * @param GenerateConfigFactory $generateConfigFactory
     * @param String $host
     * @param String $enviroment
     * @param String $urlScheme
     */
    public function __construct(GenerateConfigFactory $generateConfigFactory, $host, $enviroment, $urlScheme)
    {
        $this->generateConfigFactory = $generateConfigFactory;
        $this->hosts = $host;
        $this->environment = $enviroment;
        $this->urlScheme = $urlScheme;
        $this->config = array(
            'isFor' => 'condor',
            'onlyPath' => false
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
        $uri = UrlHelper::url(
            $config['path'],
            $this->hosts,
            $config['culture'],
            array(),
            $this->environment,
            $config['isFor'],
            $config['onlyPath'],
            $this->urlScheme
        );

        return $uri;
    }
}
