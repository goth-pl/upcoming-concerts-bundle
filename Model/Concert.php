<?php

namespace Goth\UpcomingConcertsBundle\Model;

use DateTime;

class Concert
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @var DateTime
     */
    protected $startedAt;

    /**
     * @var Venue
     */
    protected $venue;

    /**
     * @param string $url
     * @param DateTime $startedAt
     * @param Venue|null $venue
     */
    public function __construct(string $url, DateTime $startedAt, Venue $venue = null)
    {
        $this->url = $url;
        $this->startedAt = $startedAt;
        $this->venue = $venue;
    }

    /**
     * @return string
     */
    public function getUrl() : string
    {
        return $this->url;
    }

    /**
     * @return DateTime
     */
    public function getStartedAt() : DateTime
    {
        return $this->startedAt;
    }

    /**
     * @return Venue
     */
    public function getVenue() : Venue
    {
        return $this->venue;
    }
}