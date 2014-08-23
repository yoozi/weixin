<?php namespace Yoozi\Weixin\Parsers;

/**
 * Parser for route string.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class RouteParser
{
    /**
     * Parse a route string.
     *
     * Format::
     *
     *     ExampleController@method
     *
     * It will return `null` if the route string format is incorrect.
     *
     * @param string $routeString
     * @return array|null
     */
    public static function parse($routeString)
    {
        $result = explode('@', $routeString);

        if (count($result) !== 2) {
            return;
        }

        return array(
            'controller' => $result[0],
            'method' => $result[1]
        );
    }
}
