<?php namespace Yoozi\Weixin\Client;

/**
 * Weixin OAuth client interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface OAuthClientInterface
{
    /**
     * Setup client app id & secret.
     *
     * @param string $appId
     * @param string $appSecret
     */
    public function setUp($appId, $appSecret);
    
    /**
     * Generate user authorize url.
     *
     * @link http://mp.weixin.qq.com/wiki/index.php?title=网页授权获取用户基本信息
     * @param string $redirectUrl
     * @return string
     */
    public function getAuthorizeUrl($redirectUrl);

    /**
     * Get access token & open id from code.
     *
     * @link http://mp.weixin.qq.com/wiki/index.php?title=网页授权获取用户基本信息
     * @param string $code
     * @return array|null
     */
    public function getAccessToken($code);

    /**
     * Get user profile.
     *
     * Return ``null`` if errors occured.
     *
     * @param string $openId 
     * @param string $accessToken
     * @return array|null
     */
    public function getUserInfo($openId, $accessToken);
}
