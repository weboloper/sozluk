<?php

error_reporting(E_ALL);

// (new Phalcon\Debug)->listen();

use Phalcon\Loader;
use Phalcon\Mvc\Router;
use Phalcon\DI\FactoryDefault;
use Phalcon\Mvc\Application as BaseApplication;

define('BASE_PATH', dirname(__DIR__));
define('CORE_PATH', BASE_PATH . '/core');
define('APPS_PATH', BASE_PATH . '/core/apps');
define('CONTENT_PATH', BASE_PATH . '/content');

class Application extends BaseApplication
{
    /**
     * Register the services here to make them general or register in the ModuleDefinition to make them module-specific
     */
    protected function registerServices()
    {

        $di = new FactoryDefault();

        /**
         * Read services
        */
        include CORE_PATH . "/config/services.php";

        /**
         * Get config service for use in inline setup below
         */
        $config = $di->getConfig();


        include CORE_PATH . '/config/loader.php';

         

        $this->setDI($di);
    }

    public function main()
    {

        $this->registerServices();

        // Register the installed modules
        $this->registerModules([
            'frontend' => [
                'className' => 'Weboloper\Frontend\Module',
                'path'      => APPS_PATH.'/frontend/Module.php'
            ],
            'backend'  => [
                'className' => 'Weboloper\Backend\Module',
                'path'      => APPS_PATH.'/backend/Module.php'
            ],
            'error'  => [
                'className' => 'Weboloper\Error\Module',
                'path'      => APPS_PATH.'/error/Module.php'
            ]
        ]);

        echo $this->handle()->getContent();
    }
}

$application = new Application();
$application->main();
