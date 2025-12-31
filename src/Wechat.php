<?php

namespace Kyledong\WechatMpAuth;

class Wechat
{
    /**
     * 生成授权链接
     * @param $redirect_uri
     * @param $scope
     * @param $config
     * @return string
     * @throws \Exception
     */
    public static function createAuthUrl($redirect_uri, $scope = 'snsapi_base', $config = null)
    {
        if (! $config instanceof Config) {
            $config = new Config();
        }
        $appid = $config->getAppid();
        if (! $appid) {
            throw new \Exception('未正确配置appid');
        }
        return sprintf(Config::getUri('authorize'),$appid,$redirect_uri,$scope);
    }

    /**
     * 获取access_token
     * @param $code
     * @param $config
     * @return mixed
     * @throws \Exception
     */
    public static function getAccessToken($code, $config = null)
    {
        if (! $config instanceof Config) {
            $config = new Config();
        }
        $appid = $config->getAppid();
        $secret = $config->getSecret();
        if (! $appid) {
            throw new \Exception('未正确配置appid');
        }
        return HttpClient::request(Config::getUri('access_token'),[
            'appid' => $appid,
            'secret' => $secret,
            'code' => $code,
            'grant_type' => 'authorization_code'
        ]);
    }

    /**
     * 获取用户信息
     * @param $openid
     * @param $access_token
     * @return mixed
     */
    public static function getUserInfo($openid, $access_token)
    {
        return HttpClient::request(Config::getUri('userinfo'),[
            'access_token' => $access_token,
            'openid' => $openid
        ]);
    }
}