<?php namespace Yoozi\Weixin\Messages;

/**
 * Music message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class MusicMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public static function make(array $data)
    {
        return <<< XML
            <xml>
                <ToUserName><![CDATA[{$data['receiver']}]]></ToUserName>
                <FromUserName><![CDATA[{$data['sender']}]]></FromUserName>
                <CreateTime>{$data['createTime']}</CreateTime>
                <MsgType><![CDATA[music]]></MsgType>
                <Video>
                    <Title><![CDATA[{$data['title']}]]></Title>
                    <Description><![CDATA[{$data['description']}]]></Description>
                    <MusicUrl><![CDATA[{$data['musicUrl']}]]></MusicUrl>
                    <HQMusicUrl><![CDATA[{$data['hqMusicUrl']}]]></HQMusicUrl>
                    <ThumbMediaId><![CDATA[{$data['thumbMediaId']}]]></ThumbMediaId>
                </Video>
            </xml>
XML;
    }
}
