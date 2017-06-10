<?php
namespace Weboloper\Frontend\Controllers;

use Weboloper\Models\Posts;
use Weboloper\Models\Entries;
use Weboloper\Models\ModelBase;
use Weboloper\Frontend\Forms\EntryForm;

class EntriesController extends ControllerBase
{   

	public function viewAction($id )
    {

    	$entry = Entries::findFirstById($id);

    	$post = $entry->getPost();


    	$this->view->setVars(
            [
                'post'        => $post,
                'form'        => new EntryForm(),
                'entries'     => array($entry),
                'totalPages'  => $totalPages,
                'currentPage' => $page,


            ]
        );
        $this->tag->setTitle($this->escaper->escapeHtml($post->getTitle()));


     }

    public function editAction($id)
    {
    	if (!$this->auth->isLogged()) {
            return $this->response->redirect('/session/login');
        }

    	$entry = Entries::findFirstById($id);

    	if(!$entry){
    		return $this->response->redirect('/');
    	}

    	$post = $entry->getPost();
 
    	$this->view->setVars(
            [
                'entry'        => $entry,
                'post'        => $post,
                'form'        => new EntryForm($entry),
            ]
        );

    }

    public function saveAction($id)
    {
    	if(!$this->request->isPost()) {
            return $this->response->redirect('/');
        }

        if (!$this->auth->isLogged()) {
            return $this->response->redirect('/session/login');
        }

        $content = $this->request->getPost("content", "trim");

        $form = new EntryForm();

        if ($form->isValid($this->request->getPost()) == false) {
        	  return $this->response->redirect('/');
        }

        if (!$this->security->checkToken()) {
            return $this->response->redirect('/');
        }

    	$entry = Entries::findFirstById($id);

    	if(!$entry){
    		return $this->response->redirect('/');
    	}

    	$entry->content = $content;

    	if ($entry->save() == false) {
          echo "Umh, We can't store entry: ";
          foreach ($entry->getMessages() as $message) {
            echo $message;
          }
        }else{
            $this->response->redirect(
                    [   'for' => 'entryView',
                        'id' => $entry->id
                    ]
                );
        }
            	 
    }


}