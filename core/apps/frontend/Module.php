<?php

namespace Weboloper\Frontend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\DiInterface;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Db\Adapter\Pdo\Mysql;
use Phalcon\Mvc\ModuleDefinitionInterface;

use Weboloper\Plugins\Security\SecurityPlugin;
use Weboloper\Plugins\Security\NotFoundPlugin;

 
use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

use Weboloper\Volt\VoltFunctions;

class Module implements ModuleDefinitionInterface
{
    /**
     * Registers the module auto-loader
     *
     * @param DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();

        $loader->registerNamespaces(
            [
                'Weboloper\Frontend\Controllers' => APPS_PATH.'/frontend/controllers/',
                'Weboloper\Frontend\Forms' => APPS_PATH.'/frontend/forms/',
            ]
        );

        $loader->register();
    }

    /**
     * Registers services related to the module
     *
     * @param DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {


        /**
         * Dispatcher use a default namespace
         */
        $di->set('dispatcher', function () {
            $eventsManager = new EventsManager;

            
            // $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

            $dispatcher = new Dispatcher;
            $dispatcher->setEventsManager($eventsManager);
         
            $dispatcher->setDefaultNamespace('Weboloper\Frontend\Controllers');
            return $dispatcher;
        });

        // Registering the view component
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(APPS_PATH.'/frontend/views/');

            $view->registerEngines([
                '.volt' => function ($view) {
                    $config = $this->getConfig();

                    $volt = new VoltEngine($view, $this);
                    
                    $volt->setOptions([
                        'compileAlways' => TRUE,
                        'compiledPath' => $config->application->cacheDir . 'volt/',
                        'compiledSeparator' => '_'
                    ]);

                    // $volt->getCompiler()->addExtension(new VoltFunctions());
                    return $volt;
                }
            ]);

            return $view;
        });

    }



}
