# Weixin [WIP]

## This library is deprecated and not maintained, use [overtrue/wechat](https://github.com/overtrue/wechat) instead.

> This library is part of [Project Golem](http://golem.yoozi.cn/), see [yoozi/golem](https://github.com/yoozi/golem) for more info.

Weixin is a [Laravel](http://laravel.com) [package](http://laravel.com/docs/packages) for interacting with [微信公众平台](https://mp.weixin.qq.com).


## Content

- [Installation](#installation)
- [Setup](#setup)
- [Usage](#usage)


## Install

You can install this library via [Composer](http://getcomposer.org):

```bash
$ composer require yoozi/weixin --save
```

Or declare in the `composer.json`:

```json
{
  "require": {
    "yoozi/weixin": "dev-master"
  }
}
```

and install it:

```bash
$ composer install
```


## Setup


### Config

Before using this package, you have to publish the configuration file via:

```bash
$ php artisan config:publish yoozi/weixin
```

And it will create a configuration file in `your-project/app/config/packages/yoozi/weixin/`.

You should setup your weixin account information in `weixin.php`:

| name          | description                                             |
|-----------------|-----------------------------------------------------------|
| token | server side token (required) |
| app\_id | your weixin account app id (required) |
| app\_secret | your weixin account app secret key (required) |
| end\_point | weixin server event receive endpoint (required) |


### Service & Facades

To enable this package, you should add this following lines to `config/app.php`:

```php

return array(

    'providers' => array(
        // Illumniate stuffs...
        'Illuminate\Translation\TranslationServiceProvider',
        'Illuminate\Validation\ValidationServiceProvider',
        'Illuminate\View\ViewServiceProvider',
        'Illuminate\Workbench\WorkbenchServiceProvider',

        // Add weixin provider here:
        'Yoozi\Weixin\WeixinServiceProvider',
    ),

    'aliases' => array(
        'Request'        => 'Illuminate\Support\Facades\Request',
        // Be sure change the Response facade to weixin's:
        'Response'       => 'Yoozi\Weixin\Facades\Response',
        'Route'          => 'Illuminate\Support\Facades\Route',
        
        // Illuminate stuffs...
        'URL'            => 'Illuminate\Support\Facades\URL',
        'Validator'      => 'Illuminate\Support\Facades\Validator',
        'View'           => 'Illuminate\Support\Facades\View',

        // Add weixin facades here:
        'WeixinInput'    => 'Yoozi\Weixin\Facades\WeixinInput',
        'WeixinRouter'   => 'Yoozi\Weixin\Facades\WeixinRouter',
        'WeixinMessage'  => 'Yoozi\Weixin\Facades\WeixinMessage',
        'OAuthClient'    => 'Yoozi\Weixin\Facades\OAuthClient',
        'WeixinClient'   => 'Yoozi\Weixin\Facades\WeixinClient',
    ),

);
```

## Usage

Weixin will provide you:

- a router for binding server event callback,
- a weixin client for interacting with `api.weixin.qq.com`,
- a OAuth client for performing OAuth login.


### Bind Events

In `routes.php`:

```php
// Bind a text event.
WeixinRouter::bind('text', 'MyWeixinEventHandler@text');

// Bind a music event.
WeixinRouter::bind('music', 'MyWeixinEventHandler@music');

// Bind a subscribe event.
WeixinRouter::bindEvent('subscribe', 'MyWeixinEventHandler@subscribe');
// This is equivalent to:
WeixinRouter::bind('event:subscribe', 'MyWeixinEventHandler@subscribe');

// Bind a click event.
WeixinRouter::bindClick('a_key', 'MyWeixinEventHandler@clickAKey');
// This is equivalent to:
WeixinRouter::bindEvent('click:a_key', 'MyWeixinEventHandler@subscribe');
// And:
WeixinRouter::bind('event:click:a_key', 'MyWeixinEventHandler@subscribe');

// Bind a view event.
WeixinRouter::bindView('http://google.com', 'MyWeixinEventHandler@visitGoogle');

// Bind a default event.
WeixinRouter::bindDefault('MyWeixinEventHandler@defaultEvent');
```

In `MyWeixinEventHandler.php`:

```php
class MyWeixinEventHandler
{
    public function text()
    {
        $sender = WeixinInput::get('tousername');
        $receiver = WeixinInput::get('fromusername');

        $messge = WeixinMessage::text($receiver, $sender, 'Hello, world!');

        return Response::xml($message);
    }

    // Handle other events...
}
```


### Weixin Client

Weixin client can be used to:

- retrieve [access token](http://mp.weixin.qq.com/wiki/index.php?title=%E8%8E%B7%E5%8F%96access_token)
- retrieve [user's basic profile via openid](http://mp.weixin.qq.com/wiki/index.php?title=%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7%E5%9F%BA%E6%9C%AC%E4%BF%A1%E6%81%AF)

Example:

```php
// Notes:
//  You should store this access token in the cache or somewhere else
//  for reuse later.
$accessToken = WeixinClient::getAccessToken();
$openId = 'an_user_openid';

var_dump(WeixinClient::getUserInfo($openId, $accessToken));
```


### OAuth Client

Weixin OAtuth client provides you:

- generate authorize url with callback
- retrieve access token with OAuth code
- retrieve user's basic profile with access token

Example:

```php
// Redirect user to $authorizeUrl and receive the OAuth code ($code)
$authorizeUrl = OAuthClient::getAccessUrl($codeReceiveUrl);

// Get access token from code
$accessTokenAndOpenId = OAuthClient::getAccessToken($code);
$accessToken = $accessTokenAndOpenId['access_token'];
$openId = $accessTokenAndOpenId['openid'];

// Get user profile
var_dump(OAuthClient::getUserInfo($openId, $accessToken));
```
