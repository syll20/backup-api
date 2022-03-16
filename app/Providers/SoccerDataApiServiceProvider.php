<?php

namespace App\Providers;

use App\Contracts\SoccerDataApiInterface;
use Illuminate\Support\ServiceProvider;
use InvalidArgumentException;

class SoccerDataApiServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(SoccerDataApiInterface::class, function ($app) {
            $server_config = $this->setup();
            var_dump('singleton');
            return new $server_config['namespace']($server_config);
        });
/*
        $this->app->bind(Standing::class, function ($app) {
            var_dump('BIND STANDING CLASSES');
            return new GeneralStanding;
        });*/
    }

    
    public function setup($name = null)
    {
        $this->server = $name ?: $this->getDefaultProvider();

        $config = $this->getConfig($this->server);

        if (is_null($config)) {
            throw new InvalidArgumentException("The [{$name}] server has not been configured.");
        }

        return $config;
    }

    /**
     * Get the Soccer Data Api configuration.
     *
     * @param  string  $name
     * @return array|null
     */
    protected function getConfig($name)
    {
        if (! is_null($name) && $name !== 'null') {
            return $this->app['config']["soccerdataapi.servers.{$name}"];
        }

        return ['driver' => 'null'];
    }

       /**
     * Get the name of the default queue connection.
     *
     * @return string
     */
    public function getDefaultProvider()
    {
        return $this->app['config']['soccerdataapi.default'];
    }

}
