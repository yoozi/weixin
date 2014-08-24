<?php namespace Yoozi\Weixin\Client;

use Requests;

/**
 * Weixin client.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class WeixinClient implements WeixinClientInterface
{
    /**
     * Weixin retrieve access token url.
     *
     * @var string
     */
    protected $accessTokenUrl = 'https://api.weixin.qq.com/cgi-bin/token';

    /**
     * Weixin retrieve user information url.
     *
     * @var string
     */
    protected $userInfoUrl = 'https://api.weixin.qq.com/cgi-bin/user/info';

    /**
     * Access token grant type.
     *
     * @var string
     */
    protected $accessTokenGrantType = 'client_credential';

    /**
     * Weixin user profile language.
     *
     * @var string
     */
    protected $lang = 'zh_CN';

    /**
     * App id.
     *
     * @var string
     */
    protected $appId;

    /**
     * App secret.
     *
     * @var string
     */
    protected $appSecret;
    
    /**
     * {@inheritdoc}
     */
    public function setUp($appId, $appSecret)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken()
    {
        $query = array(
            'appid' => $this->appId,
            'secret' => $this->appSecret,
            'grant_type' => $this->accessTokenGrantType
        );

        $resp = Requests::request(
            $this->accessTokenUrl,
            array(),
            $query,
            Requests::GET
        );

        $data = json_decode($resp->body, true);
        if (!isset($data['access_token'])) {
            return;
        }
        return $data['access_token'];
    }

    /**
     * {@inheritdoc}
     */
    public function getUserInfo($openId, $accessToken)
    {
        $query = array(
            'openid' => $openId,
            'access_token' => $accessToken,
            'lang' => $this->lang
        );
        $resp = Requests::request(
            $this->userInfoUrl,
            array(),
            $query,
            Requests::GET
        );

        $data = json_decode($resp->body, true);
        if (isset($data['errcode'])) {
            return;
        }
        return $data;
    }
}
