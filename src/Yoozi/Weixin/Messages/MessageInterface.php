<?php namespace Yoozi\Weixin\Messages;

/**
 * Message interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface MessageInterface
{
    /**
     * Render a message.
     *
     * @param array $data
     * @return string
     */
    public static function make(array $data);
}
