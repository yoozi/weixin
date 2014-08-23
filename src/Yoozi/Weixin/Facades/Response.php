<?php namespace Yoozi\Weixin\Facades;

use Illuminate\Support\Facades\Response as IlluminateResponse;

class Response extends IlluminateResponse
{
    /**
     * Make a xml response.
     *
     * @param string $body      response xml body
     * @param int    $status    response code, defaults to 200
     * @param array  $headers   response headers, defaults to empty array.
     * @return \Illuminate\Http\Response
     */
    public static function xml($body, $status = 200, $headers = array())
    {
        $headers['Content-Type'] = 'text/xml';

        return static::make($body, $status, $headers);
    }
}
