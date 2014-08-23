<?php namespace Yoozi\Weixin;

use Illuminate\Support\ServiceProvider;

class WeixinServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('yoozi/weixin');

        include __DIR__ . '/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $prefix = 'Yoozi\Weixin\\';
        $bindings = array(
            'Core\WeixinInputInterface' => 'Core\WeixinInput',
            'Core\WeixinRouterInterface' => 'Core\WeixinRouter',
            'Core\WeixinMessageInterface' => 'Core\WeixinMessage'
        );

        foreach ($bindings as $name => $impl) {
            $this->app->bind($prefix . $name, $prefix . $impl);
        }

        $this->app->bind('Yoozi\Weixin\Client\WeixinClient', function() {
            // Setup weixin client from config.
            $client = new WeixinClient;

            $appId = Config::get('weixin::weixin.app_id');
            $appSecret = Config::get('weixin::weixin.app_secret');
            if (!$appId or !$appSecret) {
                App::abort(500, 'Weixin app id and app secret required.');
            }
            $client->setUp($appId, $appSecret);

            return $client;
        });

    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('weixin');
    }

}
