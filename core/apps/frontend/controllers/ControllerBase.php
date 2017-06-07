<?php

namespace Weboloper\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

class ControllerBase extends Controller
{
     
     /**
     * Execute before the router so we can determine if this is a private controller, and must be authenticated, or a
     * public controller that is open to all.
     *
     * @param Dispatcher $dispatcher
     * @return boolean
     */
    public function beforeExecuteRoute(Dispatcher $dispatcher)
    {

        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();

        if($this->config->settings->maintance == true)
        {   
            if( !($controller == 'session' && ($action == 'login' ||  $action == 'logout')) )
            {
                if(!$this->auth->isTrustModeration()){
                    $this->response->redirect('/maintance');
                }
            }
        }

        if($this->config->settings->registeration == false)
        {   
            if($controller == 'session' && $action == 'signup' )
            {
                $this->response->redirect('/');
            }
        }

    }

    public function onConstruct()
    {
            $this->view->setVars([
            'auth'          => $this->auth->getIdentity(),
            'name'          => $this->config->application->name,
            'slogan'        => $this->config->application->slogan,
            'publicUrl'     => $this->config->application->publicUrl,
            'action'        => $this->router->getActionName(),
            'controller'    => $this->router->getControllerName(),
            'baseUri'       => $this->config->application->baseUri ,
            // 'googleAnalytic'=> $this->config->googleAnalytic

        ]);
    }


}