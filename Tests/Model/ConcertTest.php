<?php

namespace Goth\UpcomingConcertsBundle\Tests\Model;

use Goth\UpcomingConcertsBundle\Model\Concert;
use Goth\UpcomingConcertsBundle\Model\Venue;
use PHPUnit\Framework\TestCase;
use DateTime;

class ConcertTest extends TestCase
{
    const CONCERT_URL = 'http://www.bandsintown.com';
    const CONCERT_DATETIME = '2017-12-01 19:00:00';

    const VENUE_NAME = 'Tauron Krakow Arena';
    const VENUE_CITY = 'Krakow';
    const VENUE_REGION = 'malopolskie';
    const VENUE_COUNTRY = 'Poland';

    /**
     * @var Concert
     */
    private $concert;

    /**
     * @var Venue
     */
    private $venue;

    protected function setUp()
    {
        parent::setUp();

        $this->venue = new Venue(
            self::VENUE_NAME,
            self::VENUE_CITY,
            self::VENUE_REGION,
            self::VENUE_COUNTRY
        );

        $this->concert = new Concert(
            self::CONCERT_URL,
            new DateTime(self::CONCERT_DATETIME),
            $this->venue
        );
    }

    public function testGetUrl()
    {
        $this->assertEquals(self::CONCERT_URL, $this->concert->getUrl());
    }

    public function testGetStartedAt()
    {
        $this->assertEquals(new DateTime(self::CONCERT_DATETIME), $this->concert->getStartedAt());
    }

    public function testGetVenue()
    {
        $this->assertEquals($this->venue, $this->concert->getVenue());
    }
}