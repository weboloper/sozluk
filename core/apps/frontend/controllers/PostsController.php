<?php
namespace Weboloper\Frontend\Controllers;

use Weboloper\Models\Posts;

class PostsController extends ControllerBase
{
    public function indexAction()
    {
    }
    

    public function viewAction($id, $slug = null )
    {
        $post = Posts::findFirstById($id);

        return var_dump($post);

        if (!$post || !$this->postService->isPublished($post)) {
            $this->response->setStatusCode(404);
            $this->flashSession->error(t("Sorry! We can't seem to find the page you're looking for."));
            $this->dispatcher->forward([
                'controller' => 'posts',
                'action'     => 'index',
            ]);
            return;
        }
      
        $this->view->setVars(
            [
                'post'        => $post,
                'form'        => new ReplyForm(),
                'votes'       => $this->voteService->getVotes($id, Vote::OBJECT_POSTS),
                'postsReply'  => $post->getPostsWithVotes($id),
                'commentForm' => new CommentForm(),
                'userPosts'   => $post->user,
                'type'        => Posts::POST_QUESTIONS,
                'postRelated' => Posts::postRelated($post),
            ]
        );
        $this->tag->setTitle($this->escaper->escapeHtml($post->getTitle()));
        $this->view->pick('single');
    }

}
