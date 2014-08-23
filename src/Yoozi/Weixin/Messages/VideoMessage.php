<?php namespace Yoozi\Weixin\Messages;

/**
 * Video message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class VideoMessage implements MessageInterface
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
                <MsgType><![CDATA[video]]></MsgType>
                <Video>
                    <MediaId><![CDATA[{$data['mediaId']}]]></MediaId>
                    <Title><![CDATA[{$data['title']}]]></Title>
                    <Description><![CDATA[{$data['description']}]]></Description>
                </Video>
            </xml>
XML;
    }
}
