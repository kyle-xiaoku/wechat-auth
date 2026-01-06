## 概览

一个简单的微信授权工具

## 环境要求

支持的环境如下：

+ PHP >= 8.0

## 安装

推荐使用 PHP 包管理工具 [Composer](https://getcomposer.org/) 安装 SDK：

```shell
composer require kyledong/wechat-mp-auth
```

## 快速使用
以下代码示例向您展示了助手的调用方法：

### 字符串

```php
<?php

require 'vendor/autoload.php';
use Kyledong\WechatMpAuth\Wechat;
use Kyledong\WechatMpAuth\Config;

// 两种配置模式 方式一

$config = new Config('appid','secret');

// 方式二 在配置文件.env中配置 WECHAT_APPID=appid  WECHAT_SECRET=secret

// 生成授权链接 若是方式一 需传入config对象
return Wechat::createAuthUrl(urlencode('redirect_uri'),'scope',$config);

// 获取access_token 若是方式一 需传入config对象
return Wechat::getAccessToken('code',$config);
// 返回示例
{
  "access_token": "ACCESS_TOKEN",
  "expires_in": 7200,
  "refresh_token": "REFRESH_TOKEN",
  "openid": "OPENID",
  "unionid": "UNIONID",
  "is_snapshotuser": 1
}

// 获取用户信息
return Wechat::getUserInfo('openid','access_token');
// 返回示例
{   
  "openid": "OPENID",
  "nickname": NICKNAME,
  "sex": 1,
  "province":"PROVINCE",
  "city":"CITY",
  "country":"COUNTRY",
  "headimgurl":"https://thirdwx.qlogo.cn/mmopen/g3MonUZtNHkdmzicIlibx6iaFqAc56vxLSUfpb6n5WKSYVY0ChQKkiaJSgQ1dZuTOgvLLrhJbERQQ4eMsv84eavHiaiceqxibJxCfHe/46",
  "privilege":[ "PRIVILEGE1" "PRIVILEGE2"     ],
  "unionid": "o6_bmasdasdsad6_2sgVt7hMZOPfL"
}

```