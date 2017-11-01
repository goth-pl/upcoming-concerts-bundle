<?php

namespace Goth\UpcomingConcertsBundle\Tests\Renderer;

use Goth\UpcomingConcertsBundle\Model\Concert;
use Goth\UpcomingConcertsBundle\ResponseMapper\BandsintownResponseMapper;
use PHPUnit\Framework\TestCase;

class BandsintownResponseMapperTest extends TestCase
{
    const CONCERT_URL = 'http://www.acdc.com';
    const CONCERT_DATETIME = '2017-12-01 19:00:00';

    const VENUE_NAME = 'Tauron Krakow Arena';
    const VENUE_CITY = 'Krakow';
    const VENUE_REGION = 'malopolskie';
    const VENUE_COUNTRY = 'Poland';

    public function testMapConcerts()
    {
        $concertData = array(
            array(
                'url' => self::CONCERT_URL,
                'datetime' => self::CONCERT_DATETIME,
                'venue' => array(
                    'name' => self::VENUE_NAME,
                    'city' => self::VENUE_CITY,
                    'region' => self::VENUE_REGION,
                    'country' => self::VENUE_COUNTRY
                )
            )

        );

        $responseMapper = new BandsintownResponseMapper();

        $concerts = $responseMapper->mapConcerts(json_decode(json_encode($concertData)));

        foreach($concerts as $concert) {
            $this->assertInstanceOf(Concert::class, $concert);
        }
    }
}