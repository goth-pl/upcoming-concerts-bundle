<?php

namespace Goth\UpcomingConcertsBundle\Provider;

interface ProviderInterface
{
    /**
     * @param string $artistName
     * @param array $options
     *
     * @return Concert[]
     */
    public function getByArtistName(string $artistName, array $options = array()) : array;
}