<?php namespace Yoozi\Weixin\Core;

/**
 * Weixin event callbacks router interface.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
interface WeixinRouterInterface
{
    /**
     * Bind an event callback.
     *
     * @param string $pattern       pattern name
     * @param string $routeString   route string
     * @return void
     */
    public function bind($pattern, $routeString);

    /**
     * Bind an default event callback.
     *
     * @param string $routeString   route string
     * @return void
     */
    public function bindDefault($routeString);

    /**
     * Bind an push event callback.
     *
     * @param string $pattern       pattern name
     * @param string $routeString   route string
     * @return void
     */
    public function bindEvent($pattern, $routeString);

    /**
     * Bind an click event callback.
     *
     * @param string $buttonKey     button name
     * @param string $routeString   route string
     * @return void
     */
    public function bindClick($buttonKey, $routeString);

    /**
     * Bind a link-clicked event callback.
     *
     * @param string $url           url
     * @param string $routeString   route string
     * @return void
     */
    public function bindView($url, $routeString);

    /**
     * Get a callback.
     *
     * @param string $pattern
     * @return string|null
     */
    public function getCallback($pattern);
}
