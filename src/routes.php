<?php

Route::any(
    Config::get('weixin::weixin.endpoint'),
    'Yoozi\Weixin\Controllers\WeixinController@dispatch'
);
