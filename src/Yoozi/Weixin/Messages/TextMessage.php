<?php namespace Yoozi\Weixin\Messages;

/**
 * Text message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class TextMessage implements MessageInterface
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
                <MsgType><![CDATA[text]]></MsgType>
                <Content><![CDATA[{$data['content']}]]></Content>
            </xml>
XML;
    }
}
