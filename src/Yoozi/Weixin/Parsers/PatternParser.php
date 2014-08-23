<?php namespace Yoozi\Weixin\Parsers;

/**
 * Weixin event pattern parser & builder.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class PatternParser
{
    /**
     * Event level delimiter.
     *
     * @var string
     */
    protected static $delimiter = ':';

    /**
     * Parse from weixin's input.
     *
     * @param array $income
     * @return string
     */
    public static function parse(array $income)
    {
        $parts = array();

        // Message type
        array_push($parts, strtolower($income['msgtype']));

        // Event name
        if (isset($income['event'])) {
            array_push($parts, strtolower($income['event']));
        }

        // Event details
        if (isset($income['eventkey'])) {
            array_push($parts, $income['eventkey']);
        }

        return static::join($parts);
    }

    /**
     * Downgrade an event pattern.
     *
     * Example:
     *
     *      // Full pattern:
     *      event:click:button
     *
     *      // Downgraded:
     *      event:click
     *
     *      // Downgraded:
     *      event
     *
     *      // Downgraded:
     *      NULL
     *
     * @param string $pattern
     * @return string|null
     */
    public static function downGrade($pattern)
    {
        $parts = explode(static::$delimiter, $pattern);
        array_pop($parts);

        return static::join($parts);
    }

    /**
     * Join a pattern.
     *
     * @param array $parts
     * @return string|null
     */
    public static function join($parts)
    {
        if (count($parts) === 0) {
            return null;
        }
        return implode(static::$delimiter, $parts);
    }
}
