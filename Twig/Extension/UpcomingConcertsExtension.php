<?php

namespace Goth\UpcomingConcertsBundle\Twig\Extension;

use Goth\UpcomingConcertsBundle\Renderer\UpcomingConcertsRenderer;
use Twig_Extension;
use Twig_SimpleFunction;

class UpcomingConcertsExtension extends Twig_Extension
{
    /**
     * @var UpcomingConcertsRenderer
     */
    protected $upcomingConcertsRenderer;

    /**
     * @param UpcomingConcertsRenderer $upcomingConcertsRenderer
     */
    public function __construct(UpcomingConcertsRenderer $upcomingConcertsRenderer)
    {
        $this->upcomingConcertsRenderer = $upcomingConcertsRenderer;
    }

    /**
     * @return array
     */
    public function getFunctions() : array
    {
        return array(
            new Twig_SimpleFunction(
                'goth_upcoming_concerts_render',
                array($this, 'render'),
                array('is_safe' => array('html'))
            ),
        );
    }

    /**
     * @param string $artistName
     * @param array $options
     * @param string|null $provider
     *
     * @return string
     */
    public function render(string $artistName, array $options = array(), $provider = null) : string
    {
        return $this->upcomingConcertsRenderer->render($artistName, $options, $provider);
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return 'goth_upcoming_concerts';
    }
}