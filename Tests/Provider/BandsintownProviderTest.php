<?php

namespace Goth\UpcomingConcertsBundle\Tests\Provider;

use Goth\UpcomingConcertsBundle\Model\Concert;
use Goth\UpcomingConcertsBundle\Provider\BandsintownProvider;
use Goth\UpcomingConcertsBundle\Provider\Http;
use Goth\UpcomingConcertsBundle\ResponseMapper\BandsintownResponseMapper;
use PHPUnit\Framework\TestCase;

class BandsintownProviderTest extends TestCase
{
    /**
     * @var Http
     */
    private $httpMock;

    protected function setUp()
    {
        parent::setUp();

        $this->httpMock = new class extends Http {
            public function request(string $method, string $url, array $data = array(), array $headers = array()): array
            {
                $concertData = array(
                    array(
                        'url' => 'http://www.acdc.com',
                        'datetime' => '2017-12-01 19:00:00',
                        'venue' => array(
                            'name' => 'Tauron Krakow Arena',
                            'city' => 'Krakow',
                            'region' => 'malopolskie',
                            'country' => 'Poland'
                        )
                    )

                );

                return array(
                    'code' => 200,
                    'body' => json_decode(json_encode($concertData))
                );
            }
        };
    }

    public function testGetByArtistName()
    {
        $responseMapper = new BandsintownResponseMapper();
        $provider = new BandsintownProvider($this->httpMock, $responseMapper, 'id');

        $concerts = $provider->getByArtistName('name', array());

        foreach($concerts as $concert) {
            $this->assertInstanceOf(Concert::class, $concert);
        }
    }
}