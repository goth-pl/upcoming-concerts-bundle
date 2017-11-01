<?php

namespace Goth\UpcomingConcertsBundle\Provider;

class Http
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';

    /**
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return array
     */
    public function get(string $url, array $data = array(), array $headers = array()) : array
    {
        return $this->request(self::METHOD_GET, $url, $data, $headers);
    }

    /**
     * @param string $method
     * @param string $url
     * @param array $data
     * @param array $headers
     *
     * @return array
     */
    public function request(string $method, string $url, array $data = array(), array $headers = array()) : array
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array_merge(
            $headers, array('Content-type: application/json')
        ));

        switch(strtoupper($method)) {
            case self::METHOD_GET:
                $url .= $this->parseParams($data);

                break;
            case self::METHOD_POST:
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

                break;
        }

        curl_setopt($ch, CURLOPT_URL, $url);

        $response = curl_exec($ch);
        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return array(
            'code' => $code,
            'body' => json_decode($response)
        );
    }

    /**
     * @param array $params
     *
     * @return string
     */
    protected function parseParams(array $params = array()) : string
    {
        if (count($params) === 0) {
            return '';
        }

        $parsedParams = implode(
            '&',
            array_map(
                function($index, $value) {
                    return "$index=$value";
                },
                array_keys($params),
                $params
            )
        );

        return "?$parsedParams";
    }
}