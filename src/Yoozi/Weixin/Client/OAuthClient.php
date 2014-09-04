<?php namespace Yoozi\Weixin\Client;

use Requests;

/**
 * Weixin OAuth client.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class OAuthClient implements OAuthClientInterface
{
    /**
     * Weixin authorize url.
     *
     * @var string
     */
    protected $authUrl = 'https://open.weixin.qq.com/connect/oauth2/authorize';

    /**
     * Weixin retrieve access token url.
     *
     * @var string
     */
    protected $accessTokenUrl = 'https://api.weixin.qq.com/sns/oauth2/access_token';

    /**
     * Weixin retrieve user information url.
     *
     * @var string
     */
    protected $userInfoUrl = 'https://api.weixin.qq.com/sns/userinfo';

    /**
     * Weixin authorize scope.
     *
     * @var string
     */
    protected $authScope = 'snsapi_userinfo';

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
    public function getAuthorizeUrl($redirectUrl, $state = '')
    {
        $query = http_build_query(array(
            'appid' => $this->appId,
            'redirect_uri' => $redirectUrl,
            'response_type' => 'code',
            'scope' => $this->authScope,
            'state' => $state
        ));

        return $this->authUrl . '?' . $query . '#wechat_redirect';
    }

    /**
     * {@inheritdoc}
     */
    public function getAccessToken($code)
    {
        $query = array(
            'appid' => $this->appId,
            'secret' => $this->appSecret,
            'code' => $code,
            'grant_type' => 'authorization_code'
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
        return $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserInfo($openId, $accessToken)
    {
        $query = array(
            'access_token' => $accessToken,
            'openid' => $openId,
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
