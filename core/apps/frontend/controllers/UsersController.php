<?php
namespace Weboloper\Frontend\Controllers;

use Phalcon\Tag;
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Weboloper\Frontend\Forms\ChangePasswordForm;
use Weboloper\Models\ModelBase;
use Weboloper\Models\Users;
use Weboloper\Models\Entries;
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

        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 15;
        $params = null;

        $join = [
                'type'  => 'leftjoin',
                'model' => 'Posts',
                'on'    => 'e.postId = p.id',
                'alias' => 'p'

            ];

        list($itemBuilder, $totalBuilder) =
                ModelBase::prepareQueriesEntries( $join , false, $perPage);

        $type   = Entries::TYPE_ENTRY;
        $status = Entries::STATUS_PUBLISHED;
        $conditions = "e.userId = ?0 AND e.deletedAt = 0 AND e.type  = '{$type}' AND e.status = '{$status}'";
        $params = array($user->id);
        $itemBuilder->andWhere($conditions);
        $totalBuilder->andWhere($conditions);

        $totalEntries= $totalBuilder->getQuery()->setUniqueRow(true)->execute($params);
        $totalPages = ceil($totalEntries->count / $perPage);

        $offset     = ($page - 1) * $perPage ;
        if ($page > 1) {
            $itemBuilder->offset($offset);
        }

       
        $this->view->setVars(
            [   
                'user'     => $user,
                'entries'     => $itemBuilder->getQuery()->execute($params),
                'totalPages'  => $totalPages,
                'currentPage' => $page,


            ]
        );
 

    }
}
