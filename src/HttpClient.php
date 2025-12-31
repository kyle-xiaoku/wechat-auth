<?php

namespace Kyledong\WechatMpAuth;

use GuzzleHttp\Client;

class HttpClient
{
    public static function request($uri,$data = [],$method = 'get')
    {
        $client = new Client([
            'base_uri' => Config::getHost()
        ]);
        $params = ['json' => $data];
        $result = $client->request($method, $uri, $params);
        return json_decode($result->getBody()->getContents(), true);
    }
}