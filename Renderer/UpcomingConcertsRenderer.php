<?php

namespace Goth\UpcomingConcertsBundle\Renderer;

use Goth\UpcomingConcertsBundle\Provider\ProviderInterface;
use Twig_Environment;
use InvalidArgumentException;
use UnexpectedValueException;

class UpcomingConcertsRenderer
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * @var string|null
     */
    protected $defaultProvider;

    /**
     * @var array
     */
    protected $providers;

    /**
     * @param Twig_Environment $twig
     * @param array $providers
     * @param string|null $defaultProvider
     */
    public function __construct(Twig_Environment $twig, $defaultProvider = null, array $providers = array())
    {
        $this->twig = $twig;
        $this->defaultProvider = $defaultProvider;
        $this->providers = $providers;
    }

    /**
     * @param string $alias
     * @param ProviderInterface $provider
     */
    public function addProvider(string $alias, ProviderInterface $provider)
    {
        $this->providers[$alias] = $provider;
    }

    /**
     * @param string $alias
     *
     * @return ProviderInterface
     */
    public function getProvider(string $alias) : ProviderInterface
    {
        if (!isset($this->providers[$alias])) {
            throw new UnexpectedValueException("Unknown provider: '$alias'");
        }

        return $this->providers[$alias];
    }

    /**
     * @return ProviderInterface
     */
    public function getDefaultProvider() : ProviderInterface
    {
        if (!isset($this->defaultProvider)) {
            throw new InvalidArgumentException("Default provider is not set");
        }

        return $this->getProvider($this->defaultProvider);
    }

    /**
     * @param string $artistName
     * @param array $options
     * @param null $provider
     *
     * @return string
     */
    public function render(string $artistName, array $options = array(), $provider = null) : string
    {
        $provider = $provider ? $this->getProvider($provider) : $this->getDefaultProvider();

        return $this->twig->render(
            'GothUpcomingConcertsBundle::upcoming_concerts.html.twig',
            array(
                'artistName' => $artistName,
                'concerts' => $provider->getByArtistName($artistName, $options)
            )
        );
    }
}