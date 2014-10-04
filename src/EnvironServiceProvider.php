<?php

namespace Neemzy\Silex\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Neemzy\Environ\Manager;
use Neemzy\Environ\Environment;

class EnvironServiceProvider implements ServiceProviderInterface
{
    /**
     * @var array Environment configurations collection
     */
    protected $environments;



    /**
     * Constructor
     *
     * @param array $environments Environment configurations collection
     *
     * @return void
     */
    public function __construct(array $environments)
    {
        $this->environments = $environments;
    }



    /**
     * Registers this service on the given app
     *
     * @param Silex\Application $app Application instance
     *
     * @return void
     */
    public function register(Application $app)
    {
        $app['environ'] = $app->share(
            function () use ($app) {
                $manager = new Manager();

                foreach ($this->environments as $name => $environment) {
                    $manager->add($name, $environment);
                }

                $manager->init();
                return $manager;
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
