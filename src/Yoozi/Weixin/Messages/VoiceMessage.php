<?php namespace Yoozi\Weixin\Messages;

/**
 * Voice message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class VoiceMessage implements MessageInterface
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
                <MsgType><![CDATA[voice]]></MsgType>
                <Voice>
                    <MediaId><![CDATA[{$data['mediaId']}]]></MediaId>
                </Voice>
            </xml>
XML;
    }
}
