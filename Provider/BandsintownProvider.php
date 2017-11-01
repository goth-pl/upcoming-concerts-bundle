<?php

namespace Goth\UpcomingConcertsBundle\Provider;

use Goth\UpcomingConcertsBundle\ResponseMapper\BandsintownResponseMapper;

class BandsintownProvider implements ProviderInterface
{
    const API_URL = 'https://rest.bandsintown.com';

    /**
     * @var Http
     */
    protected $http;

    /**
     * @var BandsintownResponseMapper
     */
    protected $mapper;

    /**
     * @var string
     */
    protected $appId;

    /**
     * @var array
     */
    protected $defaultData;

    /**
     * @param Http $http
     * @param BandsintownResponseMapper $mapper
     * @param string $appId
     */
    public function __construct(Http $http, BandsintownResponseMapper $mapper, string $appId)
    {
        $this->http = $http;
        $this->mapper = $mapper;
        $this->appId = $appId;

        $this->defaultData = array(
            'app_id' => $this->appId
        );
    }

    /**
     * @param string $artistName
     * @param array $options
     *
     * @return Concert[]
     */
    public function getByArtistName(string $artistName, array $options = array()) : array
    {
        $path = "/artists/$artistName/events";

        $response = $this->http->get($this->buildUrl($path), $this->defaultData);

        if ($response['code'] !== 200) {
            return array();
        }

        return $this->mapper->mapConcerts($response['body']);
    }

    /**
     * @param $path
     *
     * @return string
     */
    protected function buildUrl($path) : string
    {
        return self::API_URL . $path;
    }

}