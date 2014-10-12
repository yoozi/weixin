<?php namespace Yoozi\Weixin\Core;

use Yoozi\Weixin\Parsers\PatternParser;

/**
 * Weixin event callbacks router.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class WeixinRouter implements WeixinRouterInterface
{
    /**
     * Default event.
     *
     * @var string
     */
    protected $defaultEventPattern = 'default';

    /**
     * Binded callbacks.
     *
     * @var array
     */
    protected $callbacks = array();

    /**
     * {@inheritdoc}
     */
    public function bind($pattern, $routeString)
    {
        $this->callbacks[$pattern] = $routeString;
    }

    /**
     * {@inheritdoc}
     */
    public function bindDefault($routeString)
    {
        $this->bind($this->defaultEventPattern, $routeString);
    }

    /**
     * {@inheritdoc}
     */
    public function bindEvent($pattern, $routeString)
    {
        $this->bind(
            $this->buildPattern(array('event', $pattern)),
            $routeString
        );
    }

    /**
     * {@inheritdoc}
     */
    public function bindClick($buttonKey, $routeString)
    {
        $this->bindEvent(
            $this->buildPattern(array('click', $buttonKey)),
            $routeString
        );
    }

    /**
     * {@inheritdoc}
     */
    public function bindView($url, $routeString)
    {
        $this->bindEvent(
            $this->buildPattern(array('view', $url)),
            $routeString
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getCallback($pattern)
    {
        while (!is_null($pattern)) {
            if ($this->hasCallback($pattern)) {
                return $this->callbacks[$pattern];
            }

            // Expand scope.
            $pattern = PatternParser::downGrade($pattern);
        }

        if ($this->hasCallback($this->defaultEventPattern)) {
            return $this->callbacks[$this->defaultEventPattern];
        }

    } 

    /**
     * Check if the pattern has callback.
     *
     * @param string $pattern
     * @return boolean
     */
    protected function hasCallback($pattern)
    {
        return (isset($this->callbacks[$pattern]));
    }

    /**
     * Build an event pattern.
     *
     * @param array $parts
     * @return string
     */
    protected function buildPattern(array $parts)
    {
        return PatternParser::join($parts);
    }
}
