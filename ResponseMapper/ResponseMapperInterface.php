<?php

namespace Goth\UpcomingConcertsBundle\ResponseMapper;

interface ResponseMapperInterface
{
    /**
     * @param array $response
     *
     * @return Concert[]
     */
    public function mapConcerts(array $response = array()) : array;
}