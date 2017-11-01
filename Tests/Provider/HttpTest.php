<?php

namespace Goth\UpcomingConcertsBundle\Tests\Provider;

use Goth\UpcomingConcertsBundle\Provider\Http;
use PHPUnit\Framework\TestCase;

class HttpTest extends TestCase
{
    public function testParseParams()
    {
        $http = new class extends Http {
            public function _parseParams(array $params = array()) : string
            {
                return $this->parseParams($params);
            }
        };

        $params = array(
            'apikey' => 'test',
            'order' => 'desc'
        );

        $expectedResult = '?apikey=test&order=desc';

        $parsedParams = $http->_parseParams($params);

        $this->assertEquals($expectedResult, $parsedParams);
    }
}