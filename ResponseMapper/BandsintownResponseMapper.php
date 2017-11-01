<?php

namespace Goth\UpcomingConcertsBundle\ResponseMapper;

use Goth\UpcomingConcertsBundle\Model\Concert;
use Goth\UpcomingConcertsBundle\Model\Venue;
use DateTime;

class BandsintownResponseMapper implements ResponseMapperInterface
{
    /**
     * @param array $response
     *
     * @return Concert[]
     */
    public function mapConcerts(array $response = array()) : array
    {
        return array_map(
            function($concertData) {
                $venue = new Venue(
                    $concertData->venue->name,
                    $concertData->venue->city,
                    $concertData->venue->region,
                    $concertData->venue->country
                );

                $concert = new Concert(
                    $concertData->url,
                    new DateTime($concertData->datetime),
                    $venue
                );

                return $concert;
            },
            $response
        );
    }
}