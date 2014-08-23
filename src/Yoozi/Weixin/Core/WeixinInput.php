<?php namespace Yoozi\Weixin\Core;

/**
 * Weixin input accessor.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class WeixinInput implements WeixinInputInterface
{
    /**
     * Income data.
     *
     * @var array
     */
    protected $data;

    /**
     * {@inheritdoc}
     */
    public function get($key, $default = null)
    {
        if (!isset($this->data[$key])) {
            return $default;
        }

        return $this->data[$key];
    }

    /**
     * {@inheritdoc}
     */
    public function set($data)
    {
        foreach ($data as $k => $v) {
            $this->data[$k] = $v;
        }
    }
}
