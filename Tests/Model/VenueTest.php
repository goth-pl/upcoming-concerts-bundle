<?php

namespace Goth\UpcomingConcertsBundle\Tests\Model;

use Goth\UpcomingConcertsBundle\Model\Venue;
use PHPUnit\Framework\TestCase;

class VenueTest extends TestCase
{
    const VENUE_NAME = 'Tauron Krakow Arena';
    const VENUE_CITY = 'Krakow';
    const VENUE_REGION = 'malopolskie';
    const VENUE_COUNTRY = 'Poland';

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
    }

    public function testGetName()
    {
        $this->assertEquals(self::VENUE_NAME, $this->venue->getName());
    }

    public function testGetCity()
    {
        $this->assertEquals(self::VENUE_CITY, $this->venue->getCity());
    }

    public function testGetRegion()
    {
        $this->assertEquals(self::VENUE_REGION, $this->venue->getRegion());
    }

    public function testGetCountry()
    {
        $this->assertEquals(self::VENUE_COUNTRY, $this->venue->getCountry());
    }
}