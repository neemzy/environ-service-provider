<?php

namespace Neemzy\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Neemzy\Environ\Manager;
use Neemzy\Environ\Environment;

class EnvironServiceProvider implements ServiceProviderInterface
{
    /**
     * @var Neemzy\Environ\Manager Environ instance
     */
    protected $instance;



    /**
     * Constructor
     *
     * Instantiates Environ
     *
     * @return void
     */
    public function __construct()
    {
        $this->instance = new Manager();
    }



    /**
     * Registers this service on the given app
     *
     * @param Silex\Application $app          Application instance
     * @param array             $environments Environment collection
     *
     * @return void
     */
    public function register(Application $app, array $environments)
    {
        $app['environ'] = $app->share(
            function () use ($app, $environments) {
                foreach ($environments as $name => $environment) {
                    $this->instance->add($name, $environment);
                }

                return $this->instance;
            }
        );
    }



    /**
     * Bootstraps the application
     *
     * @return void
     */
    public function boot(Application $app)
    {
    }
}
