<?php namespace Yoozi\Weixin\Messages;

/**
 * Articles message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class ArticlesMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public static function make(array $data)
    {
        $articles = implode('\n', $data['articles']);
        $articlesCount = count($data['articles']);

        return <<< XML
            <xml>
                <ToUserName><![CDATA[{$data['receiver']}]]></ToUserName>
                <FromUserName><![CDATA[{$data['sender']}]]></FromUserName>
                <CreateTime>{$data['createTime']}</CreateTime>
                <MsgType><![CDATA[news]]></MsgType>
                <ArticleCount>$articlesCount</ArticleCount>
                <Articles>
                    $articles
                </Articles>
            </xml>
XML;
    }
}
