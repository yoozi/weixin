<?php namespace Yoozi\Weixin\Controllers;

use App;
use Input;
use Config;
use Request;
use WeixinInput;
use WeixinRouter;
use Yoozi\Weixin\Parsers\RouteParser;
use Yoozi\Weixin\Parsers\IncomeParser;
use Yoozi\Weixin\Parsers\PatternParser;

/**
 * Weixin events receive controller.
 *
 * @package     goleam/weixin
 * @author      hbc <bcxxxxxx@gmail.com>
 * @copyright   2014 yoozi.cn
 */
class WeixinController extends \BaseController
{
    /**
     * Weixin token
     *
     * @var string
     */
    protected $token;

    public function __construct()
    {
        $this->token = Config::get('weixin::weixin.token');
        if (!$this->token) {
            App::abort(500, 'Weixin token required.');
        }

        if (!Config::get('app.debug')) {
            $this->beforeFilter('@validateSignature');
        }
    }

    /**
     * Dispatch event.
     *
     * @return mixed
     */
    public function dispatch()
    {
        // It's an echo event.
        if (Request::method() !== 'POST') {
            return $this->echoStr();
        }

        // Prepare income data.
        $income = IncomeParser::parse(Request::getContent());
        WeixinInput::set($income);

        // Find handler.
        $pattern = PatternParser::parse($income);
        $routeString = WeixinRouter::find($pattern);
        if (!$routeString) {
            return $this->missingEvent();
        }
        $route = RouteParser::parse($routeString);
        if (!$route) {
            return $this->missingEvent();
        }

        // Execute handler.
        $controller = App::make($route['controller']);
        return $controller->{$route['method']}();
    }

    /**
     * Echo event handler.
     *
     * @link http://mp.weixin.qq.com/wiki/index.php?title=接入指南
     * @return string
     */
    public function echoStr()
    {
        return Input::get('echostr');
    }

    /**
     * Fallback event handler.
     *
     * @return string
     */
    public function missingEvent()
    {
        return 'Cannot handle event.';
    }

    /**
     * Validate weixin request signature.
     *
     * @link http://mp.weixin.qq.com/wiki/index.php?title=接入指南
     * @return \Response|null
     */
    public function validateSignature()
    {
        $signature = Input::get('signature');
        $timestamp = Input::get('timestamp');
        $nonce = Input::get('nonce');

        $group = array($this->token, $timestamp, $nonce);
        sort($group, SORT_STRING);
        $ourSignature = sha1(implode($group));

        if ($ourSignature !== $signature) {
            App::abort(403, 'Invalid token.');
        }
    }
}
