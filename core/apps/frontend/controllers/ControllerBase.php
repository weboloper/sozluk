<?php

namespace Weboloper\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

// use Weboloper\Models\Services\Service;
use Weboloper\Models\Posts;

class ControllerBase extends Controller
{
     
     protected $postService;

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
            'feeds'         => self::getFeed()

        ]);
    }
 
    // public function inject(Service\Post $postService)
    // {
    //     $this->postService = $postService;

    // }


    public function getFeed($page = 1)
    {
        $solframe = ($this->session->has('solframe')) ? $this->session->get('solframe') : 'hot';

        $limit = 5;
        $offset     = ($page - 1) * $limit + 1;

        switch ($solframe) {
            case 'hot':
                # code...
                return Posts::getHotPosts($limit, $offset);
                break;
            
            default:
                # new...
                return Posts::getNewPosts($limit, $offset);
                break;
        }
    }

    public function moreAction()
    {
        return self::getFeed(2);
    }
}