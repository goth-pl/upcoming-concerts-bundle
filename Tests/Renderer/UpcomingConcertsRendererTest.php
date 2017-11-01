<?php

namespace Goth\UpcomingConcertsBundle\Tests\Renderer;

use Goth\UpcomingConcertsBundle\Renderer\UpcomingConcertsRenderer;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;
use UnexpectedValueException;

class UpcomingConcertsRendererTest extends TestCase
{
    private $twigMock;

    protected function setUp()
    {
        parent::setUp();

        $this->twigMock = $this->createMock('Twig\\Environment');

    }

    public function testAddGetProvider()
    {
        $renderer = $this->createUpcomingConcertsRenderer(null, array());

        $firstProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');

        $renderer->addProvider('firstProvider', $firstProvider);

        $this->assertEquals($firstProvider, $renderer->getProvider('firstProvider'));
    }

    public function testGetProviderForUnknowProvider()
    {
        $this->expectException(UnexpectedValueException::class);

        $renderer = $this->createUpcomingConcertsRenderer(null, array());

        $firstProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');

        $renderer->addProvider('firstProvider', $firstProvider);

        $renderer->getProvider('unknownProvider');

    }

    public function testGetDefaultProvider()
    {
        $firstProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');
        $secondProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');

        $providers = array(
            'firstProvider' => $firstProvider,
            'secondProvider' => $secondProvider
        );

        $defaultProvider = 'firstProvider';

        $renderer = $this->createUpcomingConcertsRenderer($defaultProvider, $providers);

        $this->assertEquals($firstProvider, $renderer->getDefaultProvider());
    }

    public function testGetDefaultProviderNotDefaultProviderSpecified()
    {
        $this->expectException(InvalidArgumentException::class);

        $firstProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');
        $secondProvider = $this->createMock('Goth\\UpcomingConcertsBundle\Provider\ProviderInterface');

        $providers = array(
            'firstProvider' => $firstProvider,
            'secondProvider' => $secondProvider
        );

        $renderer = $this->createUpcomingConcertsRenderer(null, $providers);

        $renderer->getDefaultProvider();
    }

    private function createUpcomingConcertsRenderer($defaultProvider = null, array $providers = array()) : UpcomingConcertsRenderer
    {
        return new UpcomingConcertsRenderer(
           $this->twigMock,
           $defaultProvider,
           $providers
        );
    }
}