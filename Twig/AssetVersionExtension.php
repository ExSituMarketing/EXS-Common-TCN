<?php

namespace exs\TcnCommonBundle\Twig;

use Symfony\Component\HttpKernel\Kernel;

/**
 * Class AssetVersionExtension
 * @package exs\TcnCommonBundle\Twig
 */
class AssetVersionExtension extends \Twig_Extension
{
    /**
     * @var string
     */
    private $debug;

    /**
     * @var string
     */
    private $env;

    /**
     * @var string
     */
    private $version;

    /**
     * AssetVersionExtension constructor.
     * @param Kernel $kernel
     * @param $customAssetVersion
     */
    public function __construct(Kernel $kernel, $customAssetVersion)
    {
        $this->debug = $kernel->isDebug();
        $this->env = $kernel->getEnvironment();
        $this->version = $customAssetVersion;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('assetVersion', array($this, 'assetVersion')),
        );
    }

    /**
     * @param string $str
     * @return string
     */
    public function assetVersion($str = '')
    {
        if (
            (false === $this->debug)
            && ('test' !== $this->env)
        ) {
            return '/ver'.$this->version.$str;
        } else {
            return $str;
        }
    }

    /**
     * Returns the extension name.
     *
     * @return string
     */
    public function getName()
    {
        return 'assetVersion_extension';
    }
}
