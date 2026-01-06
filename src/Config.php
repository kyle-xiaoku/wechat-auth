<?php

namespace Kyledong\WechatMpAuth;

class Config
{
    private const OPENHOST = 'https://open.weixin.qq.com/';
    private const APIHOST = 'https://api.weixin.qq.com';

    private $appid;
    private $secret;

    public function __construct($appid = '', $secret = '')
    {
        $this->appid = $appid;
        $this->secret = $secret;
    }

    private const URI = [
        'authorize' => 'connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=STATE#wechat_redirect',
        'access_token' => 'sns/oauth2/access_token',
        'userinfo' => 'sns/userinfo'
    ];

    public static function getHost($type = 'open')
    {
        return match ($type) {
            'open' => self::OPENHOST,
            'api' => self::APIHOST
        };
    }

    public static function getUri(string $type)
    {
        if ($type == 'authorize') {
            return self::getHost() . self::URI[$type];
        }
        return self::getHost('api') . self::URI[$type];
    }

    public function getAppid()
    {
        if (! $this->appid) {
            $this->appid = getenv('WECHAT_APPID');
        }
        return $this->appid;
    }

    public function getSecret()
    {
        if (! $this->secret) {
            $this->secret = getenv('WECHAT_SECRET');
        }
        return $this->secret;
    }
}