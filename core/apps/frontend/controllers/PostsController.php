<?php
namespace Weboloper\Frontend\Controllers;

use Weboloper\Models\Posts;
use Weboloper\Models\Entries;
use Weboloper\Models\ModelBase;
use Weboloper\Frontend\Forms\EntryForm;

class PostsController extends ControllerBase
{   

    public function indexAction()
    {
        $s = $this->request->get("s", "trim");
        
        $post =  Posts::findFirstByTitle($s);

        if($post) {
            $this->response->redirect(
                [   'for' => 'postView',
                    'id' => $post->id,
                    'slug' => $post->slug
                ]
            );
        }

    }
    

    public function viewAction($id, $slug = null )
    {

        $page    = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $post = Posts::findFirstById($id);

        if (!$post) {
            $this->response->setStatusCode(404);
            $this->flashSession->error(t("Sorry! We can't seem to find the page you're looking for."));
            $this->dispatcher->forward([
                'controller' => 'posts',
                'action'     => 'index',
            ]);
            return;
        }

        $perPage = 15;
        $params = null;
        list($itemBuilder, $totalBuilder) =
                ModelBase::prepareQueriesEntries('', false, $perPage);

        $type   = Entries::TYPE_ENTRY;
        $status = Entries::STATUS_PUBLISHED;
        $conditions = "e.deletedAt = 0 AND e.type  = '{$type}' AND e.status = '{$status}'";
        $itemBuilder->andWhere($conditions);
        $totalBuilder->andWhere($conditions);

        $totalEntries= $totalBuilder->getQuery()->setUniqueRow(true)->execute($params);
        $totalPages = ceil($totalEntries->count / $perPage);

      
        $this->view->setVars(
            [
                'post'        => $post,
                'form'        => new EntryForm(),
                // 'entries' => $post->getEntries($id, 'entry'),
                'entries'     => $itemBuilder->getQuery()->execute($params),
                'totalPages'  => $totalPages,
                'currentPage' => $page,


            ]
        );
        $this->tag->setTitle($this->escaper->escapeHtml($post->getTitle()));
     }

}
