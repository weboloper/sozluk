<?php
namespace Weboloper\Frontend\Controllers;

use Weboloper\Models\Posts;
use Weboloper\Models\Entries;
use Weboloper\Models\ModelBase;
use Weboloper\Frontend\Forms\EntryForm;
use Weboloper\Utils\Slug;

class PostsController extends ControllerBase
{   

    public function indexAction()
    {
        $s = $this->request->get("s", "trim");

        if($s != null) {

            $post =  Posts::findFirstByTitle($s);

            if($post) {
                $this->response->redirect(
                    [   'for' => 'postView',
                        'id' => $post->id,
                        'slug' => $post->slug
                    ]
                );
            }else {
                $this->view->setVars(
                    [
                        'query'        => $s,
                        'form'        => new EntryForm(),
                    ]
                );
                return $this->view->pick('posts/query');
            }

        }

        $post = Posts::findFirst(array('order' => 'RAND()'));

        $perPage = 5;
        $params = null;
        list($itemBuilder, $totalBuilder) =
                ModelBase::prepareQueriesEntries('', false, $perPage);

        $type   = Entries::TYPE_ENTRY;
        $status = Entries::STATUS_PUBLISHED;
        $conditions = "e.postId = ?0 AND e.deletedAt = 0 AND e.type  = '{$type}' AND e.status = '{$status}'";
        $params = array($post->id);
        $itemBuilder->andWhere($conditions);
        $totalBuilder->andWhere($conditions);

        $totalEntries= $totalBuilder->getQuery()->setUniqueRow(true)->execute($params);
        $totalPages = ceil($totalEntries->count / $perPage);

        $page    =  1;
        $offset     = ($page - 1) * $perPage + 1;
        if ($page > 1) {
            $itemBuilder->offset($offset);
        }
      
        $this->view->setVars(
            [
                'post'        => $post,
                'form'        => new EntryForm(),
                'entries'     => $itemBuilder->getQuery()->execute($params),
                'totalPages'  => $totalPages,
                'currentPage' => $page,


            ]
        );
        $this->tag->setTitle($this->escaper->escapeHtml($post->getTitle()));

        $this->view->pick('posts/view');
        

    }
    

    public function viewAction($id, $slug = null )
    {

        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $post = Posts::findFirstById($id);

        if (!$post) {
            $this->response->setStatusCode(404);
            $this->flashSession->error("Sorry! We can't seem to find the page you're looking for.");
            $this->dispatcher->forward([
                'controller' => 'error',
                'action'     => 'show404',
            ]);
            return;
        }

        $perPage = 15;
        $params = null;
        list($itemBuilder, $totalBuilder) =
                ModelBase::prepareQueriesEntries('', false, $perPage);

        $type   = Entries::TYPE_ENTRY;
        $status = Entries::STATUS_PUBLISHED;
        $conditions = "e.postId = ?0 AND e.deletedAt = 0 AND e.type  = '{$type}' AND e.status = '{$status}'";
        $params = array($post->id);
        $itemBuilder->andWhere($conditions);
        $totalBuilder->andWhere($conditions);

        $totalEntries= $totalBuilder->getQuery()->setUniqueRow(true)->execute($params);
        $totalPages = ceil($totalEntries->count / $perPage);

        $offset     = ($page - 1) * $perPage + 1;
        if ($page > 1) {
            $itemBuilder->offset($offset);
        }

      
        $this->view->setVars(
            [
                'post'        => $post,
                'form'        => new EntryForm(),
                'entries'     => $itemBuilder->getQuery()->execute($params),
                'totalPages'  => $totalPages,
                'currentPage' => $page,


            ]
        );
        $this->tag->setTitle($this->escaper->escapeHtml($post->getTitle()));
     }


    public function entryAction($id = null )
    {

        if(!$this->request->isPost()) {
            return $this->response->redirect('/');
        }

        if (!$this->auth->isLogged()) {
            return $this->response->redirect('/session/login');
        }

        $title = $this->request->getPost("title", "trim");
        $content = $this->request->getPost("content", "trim");

        if(empty($title) || empty($content))
        {
            return $this->response->redirect('/');
        }

        $form = new EntryForm();

        if ($form->isValid($this->request->getPost()) == false) {
              return $this->response->redirect('/');
        }

        if (!$this->security->checkToken()) {
            return $this->response->redirect('/');
        }

        $post = null;
        if(!empty($id))
        {
            $post =  Posts::findFirstById($id);

        }else
        {
            $post =  Posts::findFirstByTitle($title);
        }

        $user = $this->session->get('auth-identity');

        if(!$post){
            $post = new Posts();
            $post->title = $title;
            $post->slug = Slug::generate($title);
            $post->userId = $user['id'];
             
            if ($post->save() == false) {
              echo "Umh, We can't store post: ";
              foreach ($post->getMessages() as $message) {
                echo $message;
              }
            }  
        } 

        $entry = new Entries();
        $entry->content = $content;
        $entry->postId = $post->id;
        $entry->userId = $user['id'];

        if ($entry->save() == false) {
          echo "Umh, We can't store entry: ";
          foreach ($entry->getMessages() as $message) {
            echo $message;
          }
        }else{
            $this->response->redirect(
                    [   'for' => 'entryView',
                        'id' => $entry->id                    ]
                );
        }


    }

}
