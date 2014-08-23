<?php namespace Yoozi\Weixin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Yoozi\Weixin\Client\WeixinClient
 */
class WeixinClient extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Yoozi\Weixin\Client\WeixinClient';
    }
}
