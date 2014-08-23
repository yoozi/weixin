<?php namespace Yoozi\Weixin\Messages;

/**
 * Article message.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class ArticleMessage implements MessageInterface
{
    /**
     * {@inheritdoc}
     */
    public static function make(array $data)
    {
        return <<< XML
            <item>
                <Title><![CDATA[{$data['title']}]]></Title>
                <Description><![CDATA[{$data['description']}]]></Description>
                <PicUrl><![CDATA[{$data['picUrl']}]]></PicUrl>
                <Url><![CDATA[{$data['url']}]]></Url>
            </item>
XML;
    }
}
