<?php

namespace App\SoccerDataApi;

//use App\Contracts\SoccerDataApi;
use InvalidArgumentException;
use Illuminate\Foundation\Application as App;

/**
 * @mixin \Illuminate\Contracts\Cache\Repository
 */
class SoccerDataApiManager
{

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    protected $provider;
    protected $config = [];


    /**
     * Create a new Cache manager instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct(App $app)
    {
        $this->app = $app;
    }

/*
    public function setup($name = null)
    {
        $this->provider = $name ?: $this->getDefaultProvider();

        $config = $this->getConfig($this->provider);

        if (is_null($config)) {
            throw new InvalidArgumentException("The [{$name}] provider has not been configured.");
        }

        return $config;
    }
*/

    /**
     * Get the Soccer Data Api configuration.
     *
     * @param  string  $name
     * @return array|null
     */
 /*   protected function getConfig($name)
    {
        if (! is_null($name) && $name !== 'null') {
            return $this->app['config']["soccerdataapi.providers.{$name}"];
        }

        return ['driver' => 'null'];
    }
*/
       /**
     * Get the name of the default queue connection.
     *
     * @return string
     */
 /*   public function getDefaultProvider()
    {
        return $this->app['config']['soccerdataapi.default'];
    }
*/
}