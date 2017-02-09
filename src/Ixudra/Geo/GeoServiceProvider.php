<?php namespace Ixudra\Geo;


use Illuminate\Support\ServiceProvider;

class GeoServiceProvider extends ServiceProvider {

    /**
     * @var bool
     */
    protected $defer = false;


    /**
     * @return void
     */
    public function register()
    {
        $this->app['Geo'] = $this->app->singleton(
            function($app)
            {
                return new GeoCodingService();
            }
        );

        $configPath = __DIR__ . '/../../config/config.php';

        $this->mergeConfigFrom($configPath, 'geo');
        $this->publishes(
            array(
                $configPath         => config_path('geo.php'),
            )
        );
    }

    /**
     * @return array
     */
    public function provides()
    {
        return array('Geo');
    }

}