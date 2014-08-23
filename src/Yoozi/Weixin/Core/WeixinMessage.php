<?php namespace Yoozi\Weixin\Core;

use Yoozi\Weixin\Messages\TextMessage;
use Yoozi\Weixin\Messages\ImageMessage;
use Yoozi\Weixin\Messages\MusicMessage;
use Yoozi\Weixin\Messages\VoiceMessage;
use Yoozi\Weixin\Messages\VideoMessage;
use Yoozi\Weixin\Messages\ArticleMessage;
use Yoozi\Weixin\Messages\ArticlesMessage;

/**
 * Weixin message builder.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class WeixinMessage implements WeixinMessageInterface
{
    /**
     * {@inheritdoc}
     */
    public function text($receiver, $sender, $content)
    {
        return TextMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'createTime' => time(),
            'content' => $content
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function image($receiver, $sender, $mediaId)
    {
        return ImageMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'createTime' => time(),
            'mediaId' => $mediaId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function voice($receiver, $sender, $mediaId)
    {
        return VoiceMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'createTime' => time(),
            'mediaId' => $mediaId
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function video($receiver, $sender, $mediaId, $title = '', $desc = '')
    {
        return VideoMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'mediaId' => $mediaId,
            'title' => $title,
            'description' => $desc
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function music(
        $receiver,
        $sender,
        $thumbMediaId,
        $title = '',
        $desc = '',
        $musicUrl = '',
        $hqMusicUrl = ''
    ) {
        return MusicMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'thumbMediaId' => $thumbMediaId,
            'title' => $title,
            'description' => $desc,
            'musicUrl' => $musicUrl,
            'hqMusicUrl' => $hqMusicUrl
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function article($title, $desc, $picUrl, $url)
    {
        return ArticleMessage::make(array(
            'title' => $title,
            'description' => $desc,
            'picUrl' => $picUrl,
            'url' => $url
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function articles($receiver, $sender, $articles)
    {
        return ArticlesMessage::make(array(
            'receiver' => $receiver,
            'sender' => $sender,
            'articles' => $articles,
            'createTime' => time()
        ));
    }
}
