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
        $this->app->bind('callserver', function() {
            return new \App\Servers\CallServer;
        });

        $this->app->bind('fixture', function() {
            return new \App\Actions\Fixture;
        });

        $this->app->bind('injury', function() {
            return new \App\Actions\Injury;
        });
        $this->app->bind('scorer', function() {
            return new \App\Actions\Scorer;
        });
        $this->app->bind('h2h', function() {
            return new \App\Actions\H2h;
        });
        $this->app->bind('ranking', function() {
            return new \App\Actions\Ranking;
        });
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
