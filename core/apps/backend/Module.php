<?php

namespace Weboloper\Backend;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Dispatcher;
use Phalcon\DiInterface;
use Phalcon\Mvc\ModuleDefinitionInterface;

use Weboloper\Plugins\Security\SecurityPlugin;
use Weboloper\Plugins\Security\NotFoundPlugin;

use Phalcon\Mvc\View\Engine\Volt as VoltEngine;

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
                'Weboloper\Backend\Controllers' => APPS_PATH.'/backend/controllers/',
                'Weboloper\Backend\Forms'     => APPS_PATH.'/backend/forms/'
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

            
            $eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin);

            $eventsManager->attach('dispatch:beforeException', new NotFoundPlugin);

            $dispatcher = new Dispatcher;
            $dispatcher->setEventsManager($eventsManager);
         
            $dispatcher->setDefaultNamespace('Weboloper\Frontend\Controllers');
            return $dispatcher;
        });
        
        // Registering the view component
        $di->set('view', function () {
            $view = new View();
            $view->setViewsDir(APPS_PATH.'/backend/views/');

            $view->registerEngines([
                '.volt' => function ($view) {
                    $config = $this->getConfig();

                    $volt = new VoltEngine($view, $this);

                    $volt->setOptions([
                        'compileAlways' => TRUE,
                        'compiledPath' => $config->application->cacheDir . 'volt/',
                        'compiledSeparator' => '_'
                    ]);

                    

                    return $volt;
                }
            ]);

            return $view;
        });


    }
}
