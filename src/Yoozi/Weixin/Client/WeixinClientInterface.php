<?php namespace Yoozi\Weixin\Client;

/**
 * Weixin client interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface WeixinClientInterface
{
    /**
     * Setup client app id & secret.
     *
     * @param string $appId
     * @param string $appSecret
     */
    public function setUp($appId, $appSecret);

    /**
     * Get access token.
     *
     * @link http://mp.weixin.qq.com/wiki/index.php?title=%E8%8E%B7%E5%8F%96access_token
     * @return string
     */
    public function getAccessToken();

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
