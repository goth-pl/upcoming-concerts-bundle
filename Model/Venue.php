<?php

namespace Goth\UpcomingConcertsBundle\Model;

class Venue
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $region;

    /**
     * @var string
     */
    protected $country;

    /**
     * @param string $name
     * @param string $city
     * @param string $region
     * @param string $country
     */
    public function __construct(string $name, string $city, string $region, string $country)
    {
        $this->name = $name;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }


}