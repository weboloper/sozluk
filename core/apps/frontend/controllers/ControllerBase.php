<?php

namespace Weboloper\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\Mvc\Dispatcher;

// use Weboloper\Models\Services\Service;
use Weboloper\Models\Posts;
use Weboloper\Models\ModelBase;

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
 

    public function getFeed($page = 1)
    {        
 

        $route = $this->router->getRewriteUri();

        switch ($route) {
            case '/newposts':
                $solframe = 'newposts';
                break;
            case '/posts/newposts':
                $solframe = 'newposts';
                break;
            case '/':
                $solframe = 'newentries';
                break;
            case '/newentries':
                $solframe = 'newentries';
                break;
            case '/posts/newentries':
                $solframe = 'newentries';
                break;
            default:
                $solframe = ($this->session->has('solframe')) ? $this->session->get('solframe') : 'newentries';
                break;
        }

        
        $perPage = 6;

        if($solframe == 'newentries')
        {   
            // $join = [
            //     'type'  => 'leftjoin',
            //     'model' => 'Entries',
            //     'on'    => 'e.postId = p.id',
            //     'alias' => 'e'

            // ];
            $itemBuilder = ModelBase::prepareQueriesPosts( $join = '', false, $perPage , $type = 'entry' );
            $itemBuilder->orderBy('feedDate DESC');
            $itemBuilder->groupBy(array('p.id'));
          
        }else {
            $itemBuilder = ModelBase::prepareQueriesPosts( $join = '' , false, $perPage,  $type = 'post');
            $itemBuilder->orderBy('feedDate DESC');
            $itemBuilder->groupBy(array('p.id'));
        }
        
        $type   = Posts::TYPE_POST;
        $status = Posts::STATUS_PUBLISHED;
        $conditions = "p.type  = '{$type}' AND p.status = '{$status}'";
        $itemBuilder->where($conditions);

        $offset     = ($page - 1) * $perPage + 1;
        if ($page > 1) {
            $itemBuilder->offset($offset);
        }
        return $itemBuilder->getQuery()->execute();

        // NOT IN USE ANYMORE
        // $limit = 5;
        // $offset     = ($page - 1) * $limit + 1;

        // switch ($solframe) {
        //     case 'newposts':
        //         # code...
        //         return Posts::getNewPosts($limit, $offset);
        //         break;
            
        //     default:
        //         # new...
        //         // return Posts::getNewPostsByEntries($limit, $offset);
        //         break;
        // }
    }

    public function moreAction()
    {   

        if (!$this->request->isPost() ) {
            return $this->response->redirect('/');
        }

        

        $page = $this->request->getPost("page");

        
        // $response = new \Phalcon\Http\Response();
        $feeds = self::getFeed($page);
 
        $this->view->setVars(['feeds' => $feeds ]);
        $this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_ACTION_VIEW);
        return  $this->view->pick("partials/more");
        // return $response->setContent(json_encode( $more));
 
    }


}