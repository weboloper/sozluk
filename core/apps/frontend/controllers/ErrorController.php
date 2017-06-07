<?php
namespace Weboloper\Frontend\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\DispatcherInterface;


class ErrorController extends Controller
{
    /**
     * Triggered before executing the controller/action method.
     *
     * @param  DispatcherInterface $dispatcher
     * @return bool
     */
    public function beforeExecuteRoute(DispatcherInterface $dispatcher)
    {
        if ($dispatcher->hasParam('message')) {
            $message = $dispatcher->getParam('message');
        } else {
            $message = "Sorry! We can't seem to find the page you're looking for.";
        }

        $this->view->setVars([
            'message' => $message,
            'team'    => $this->config->get('application')->name
        ]);

        return true;
    }

    public function show400Action()
    {   

        $this->response->setStatusCode(400);
    }

    public function show401Action()
    {
        $this->response->setStatusCode(401);
        $this->response->setHeader('WWW-Authenticate', 'Digest realm="Access denied"');
    }

    public function show403Action()
    {
        $this->response->setStatusCode(403);
    }

    public function show404Action()
    {   return var_dump(1111);
        $this->response->setStatusCode(404);
    }

    public function show500Action()
    {
        $this->response->setStatusCode(500);
    }

    public function show503Action()
    {
        $this->response->setStatusCode(503);
    }
}
