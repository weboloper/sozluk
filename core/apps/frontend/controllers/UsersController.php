<?php
namespace Weboloper\Frontend\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Weboloper\Frontend\Forms\ChangePasswordForm;
use Weboloper\Models\Users;
use Phalcon\Mvc\Controller;

/**
 * Weboloper\Controllers\UsersController
 * CRUD to manage users
 */
class UsersController extends ControllerBase
{

    public function initialize()
    {
    }

    
    /**
     * Users must use this action to change its password
     */
    public function changePasswordAction()
    {
        $form = new ChangePasswordForm();

        if ($this->request->isPost()) {

            if (!$form->isValid($this->request->getPost())) {

                foreach ($form->getMessages() as $message) {
                    $this->flash->error($message);
                }
            } else {

                $user = $this->auth->getUser();

                $user->password = $this->security->hash($this->request->getPost('password'));
                $user->mustChangePassword = 'N';

                $passwordChange = new PasswordChanges();
                $passwordChange->user = $user;
                $passwordChange->ipAddress = $this->request->getClientAddress();
                $passwordChange->userAgent = $this->request->getUserAgent();

                if (!$passwordChange->save()) {
                    $this->flash->error($passwordChange->getMessages());
                } else {

                    $this->flash->success('Your password was successfully changed');

                    Tag::resetInput();
                }
            }
        }

        $this->view->form = $form;
    }



    public function viewAction($id)
    {
        $user = Users::findFirst($id);

        if (!$user) {
            $this->response->setStatusCode(404);
            $this->flashSession->error("Sorry! We can't seem to find the page you're looking for.");
            $this->dispatcher->forward([
                'controller' => 'error',
                'action'     => 'show404',
            ]);
            return;
        }

        $this->view->setVars(
            [
 
                'user'     => $user 


            ]
        );


    }
}
