<?php namespace Yoozi\Weixin\Core;

/**
 * Weixin messge builder interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface WeixinMessageInterface
{
    /**
     * text message.
     *
     * @param string $receiver
     * @param string $fromUserId
     * @param string $content
     * @return string
     */
    public function text($receiver, $sender, $content);

    /**
     * image message.
     *
     * @param string $receiver
     * @param string $sender
     * @param string $mediaId
     * @return string
     */
    public function image($receiver, $sender, $mediaId);
    
    /**
     * voice message.
     *
     * @param string $receiver
     * @param string $sender
     * @param string $mediaId
     * @return string
     */
    public function voice($receiver, $sender, $mediaId);

    /**
     * video message.
     *
     * @param string $receiver
     * @param string $sender
     * @param string $mediaId
     * @param string $title     (optional)
     * @param string $desc      (optional)
     * @return string
     */
    public function video($receiver, $sender, $mediaId, $title = '', $desc = '');

    /**
     * music message.
     *
     * @param string $receiver
     * @param string $sender
     * @param string $thumbMediaId
     * @param string $title             (optional)
     * @param string $desc              (optional)
     * @param string $musicUrl          (optional)
     * @param string $hqMusicUrl        (optional)
     * @return string
     */
    public function music(
        $receiver,
        $sender,
        $thumbMediaId,
        $title = '',
        $desc = '',
        $musicUrl = '',
        $hqMusicUrl = ''
    );

    /**
     * A rich media message.
     *
     * @param string $title     (optional)
     * @param string $desc      (optional)
     * @param string $picUrl    (optional)
     * @param string $url       (optional)
     * @return string
     */
    public function article($title, $desc, $picUrl, $url);

    /**
     * Rich media messages.
     *
     * @param string $receiver
     * @param array $articles
     * @return string
     */
    public function articles($receiver, $sender, $articles);
}
