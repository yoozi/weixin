<?php namespace Yoozi\Weixin\Core;

/**
 * Weixin input accessor interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface WeixinInputInterface
{
    /**
     * Get an item from weixin input data.
     *
     * @param string $key
     * @param mixed $default
     * @return mixed
     */
    public function get($key, $default);

    /**
     * Set weixin input data.
     * 
     * @param array $data
     * @return void
     */
    public function set($data);
}
