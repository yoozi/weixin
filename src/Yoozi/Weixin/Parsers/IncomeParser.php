<?php namespace Yoozi\Weixin\Parsers;

/**
 * Parser for weixin income xml request.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class IncomeParser
{
    /**
     * Parse content.
     *
     * @param string $raw
     * @return array
     */
    public static function parse($raw)
    {
        $xml = simplexml_load_string($raw, 'SimpleXMLElement', LIBXML_NOCDATA);

        // Make our life easier with an array.
        $array = json_decode(json_encode($xml), true);

        // Convert all keys to lowercase.
        $rv = array();
        foreach ($array as $k => $v) {
            $rv[strtolower($k)] = trim($v);
        }

        return $rv;
    }
}
